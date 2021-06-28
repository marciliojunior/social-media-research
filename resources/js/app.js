require('./main');
require('bootstrap');
require('form-serializer');

import dialog from "./components/DialogWindow";
import 'js-loading-overlay';
import Table from "./components/Table";
import 'bootstrap/dist/css/bootstrap.min.css';
import FilterToolbar from "./components/FilterToolbar";
import 'bootstrap-select';
import 'bootstrap-select/dist/css/bootstrap-select.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';

class Panel extends React.Component
{
    constructor(props)
    {
        super(props);
        this.initialFilters = {
            list: [],
            dateIni: '',
            dateEnd: '',
            social_network: [],
            fullTextSearch: '',
            gender: '',
            cityState: ''
        };
        this.state = {
            data: {},
            params: {
                page: 1,
                limit: 10
            },
            filters: {...this.initialFilters}
        };
    }

    componentDidMount()
    {
        $('#btSeedDatabase').on('click', this.seedDataBase.bind(this));

        //Check if has information on database
        if(window.social_networks && window.social_networks.length)
            this.getRecords();
        else
            $('.config').modal({backdrop: 'static', keyboard: false});
    }

    //Execute de seeder to the database
    seedDataBase()
    {
        const form = $('#formSeeder');
        const dados = form.serializeObject();

        dialog.confirm('Confirm operation? <span>All current data will be lost!</span>', 'Warning', (resp) => {
            if(!resp)
                return;

            this.overlayControl(true);

            axios.post('/database-seed', dados)
                .then((resp) => {
                    if(resp && resp.data){
                        if(resp.data.success){
                            dialog.success(resp.data.message ? resp.data.message : 'Operation successfull!', () =>{
                                document.location.reload();
                            });
                        }else
                            dialog.error(resp.data.message ? resp.data.message : ':( Sorry! An error occur on the backend!');
                    }
                })
                .catch((error) => {
                    dialog.error(':( Sorry! An error occur on the backend!');
                })
                .finally(() => {
                    this.overlayControl();
                })
            ;
        });
    }

    //Load the posts data from the backend
    getRecords()
    {
        const data = Object.assign(this.state.params, this.state.filters);

        this.overlayControl(true);

        axios.get('/posts', {params: data})
            .then((resp) => {
                if(resp.data.error){
                    dialog.error(resp.data.error);
                }
                else if(resp.data)
                    this.setState({data: resp.data});
            })
            .catch((error) => {
                dialog.error(':( Sorry! An error occur on the backend!');
            })
            .finally(() => {
                this.overlayControl();
            });
    }

    //Define pagination params
    setPaginationValue(filter, value)
    {
        const params = this.state.params;
        params[filter] = value;
        if(filter === 'limit')
            params['page'] = 1;
        this.setState({params: params}, this.getRecords);
    }

    //Define filter params
    setFilterValue(e)
    {
        if(e) {
            const filter = e.currentTarget.id;
            let value;
            if(e.currentTarget.tagName.toLowerCase() === 'select')
                value = $(e.currentTarget).selectpicker('val');
            else
                value = e.currentTarget.value;

            const current = this.state.filters;
            current[filter] = value;
            this.setState({filters: current});
        }
        else {
            this.setState({filters: {...this.initialFilters}}, () => {
                $('.selectpicker').selectpicker('refresh');
                this.runFilter();
            });
        }
    }

    //Run filter
    runFilter()
    {
        const params = this.state.params;
        params.page = 1;
        this.setState({params: {...params}}, this.getRecords);
        return false;
    }

    //Show a loading overlay
    overlayControl(show)
    {
        if(show)
            JsLoadingOverlay.show({
                "overlayBackgroundColor": "#666666",
                "overlayOpacity": 0.6,
                "spinnerIcon": "ball-spin-clockwise",
                "spinnerColor": "#000",
                "spinnerSize": "2x",
                "overlayIDName": "overlay",
                "spinnerIDName": "spinner",
                "offsetX": 0,
                "offsetY": 0,
                "containerID": null,
                "lockScroll": true,
                "overlayZIndex": 9998,
                "spinnerZIndex": 9999
            });
        else
            JsLoadingOverlay.hide();
    }

    //------

    render()
    {
        return <div>
            <FilterToolbar filters={this.state.filters} onRunFilter={this.runFilter.bind(this)} onSetFilter={this.setFilterValue.bind(this)}/>
            <Table {...this.state.data} onSetPagination={this.setPaginationValue.bind(this)}/>
        </div>;
    }
}
ReactDOM.render(<Panel/>, document.getElementById('main'));
