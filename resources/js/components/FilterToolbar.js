import React from 'react';
import dialog from "./DialogWindow";
import Inputmask from "inputmask";

class FilterToolbar extends React.Component
{
    constructor(props)
    {
        super(props);
    }

    componentDidMount()
    {
        //Activate input masks
        const selector = document.body.querySelectorAll('*[data-inputmask]');
        Inputmask().mask(selector);
    }

    //Check is has any filter applied
    hasFilters()
    {
        let has_filter = false;
        if(this.props.filters){
            Object.values(this.props.filters).map((val) => {
                if(val.length){
                    has_filter = true;
                    return true;
                }
            })
        }
        return has_filter;
    }

    //Remove all filters
    removeFilters()
    {
        this.props.onSetFilter();
    }

    //Open the instruction for date range
    dateRangeInstructions()
    {
        let message = '<p>The dates must be infomed in YYYY-MM-DD format</p>';
        message += '<p>If you enter only the start date, all posts with a date equal to or greater than the one informed will be evaluated.</p>';
        message += '<p>Conversely, if you inform only the end date, the posts with a date equal to or less than the informed will be evaluated.</p>';
        message += '<p>Informing both dates, the posts with date between the two informed will be evaluated.</p>';
        dialog.dialog('alert', 'bi bi-question-circle-fill', 'text-bold', 'Date range instructions', message);
    }

    //Run filter on press enter
    onEnterKey(e)
    {
        const key = e.which || e.keyCode;
        if(key === 13)
            this.props.onRunFilter();
    }

    render()
    {
        const listNames = window.listNames ? window.listNames : [];
        const socialNetworks = window.social_networks ? window.social_networks : [];
        const hasFilters = this.hasFilters();

        return <form className="row form mt-3 mb-3">
                <div className="col-md-2 form-group">
                    <label htmlFor="list">List Name</label>
                    <select id="list" className="selectpicker form-control" value={this.props.filters.list} data-live-search="true" onChange={this.props.onSetFilter} multiple data-actions-box="true">
                        {listNames.map((l, id) => <option value={l.id} key={id}>{l.name}</option> )}
                    </select>
                </div>

                <div className="col-md-3 form-group">
                    <label>Date range <a href="#" onClick={this.dateRangeInstructions.bind(this)} data-toggle="tooltip" title="Click for more instructions"><i className="bi bi-question-circle-fill"/></a> </label>
                    <div className="input-group">
                        <input id="dateIni" type="text" className="form-control date" data-inputmask="'mask': '9999-99-99'" value={this.props.filters.dateIni} onKeyPress={this.onEnterKey.bind(this)} onChange={this.props.onSetFilter} placeholder="initial date"/>
                        <div className="input-group-append">
                            <span className="input-group-text">at</span>
                        </div>
                        <input id="dateEnd" type="text" className="form-control date" data-inputmask="'mask': '9999-99-99'" value={this.props.filters.dateEnd} onKeyPress={this.onEnterKey.bind(this)} onChange={this.props.onSetFilter} placeholder="end date"/>
                    </div>
                </div>

                <div className="col-md-2 form-group">
                    <label htmlFor="social_network" className="form-label">Social Network</label>
                    <select id="social_network" className="selectpicker form-control" data-live-search="true" value={this.props.filters.social_network} onChange={this.props.onSetFilter} multiple data-actions-box="true">
                        {socialNetworks.map((s, id) => <option key={id} data-icon={`bi bi-${s.name.toLowerCase()}`} value={s.id}>{s.name}</option>)}
                    </select>
                </div>

                <div className="col-md-3 form-group">
                    <label htmlFor="fullTextSearch" className="form-label">Full text search on post content <a href="#" data-toggle="tooltip" title="Use commas for more the one expression"><i className="bi bi-question-circle-fill"/></a></label>
                    <input type="text" className="form-control" id="fullTextSearch" placeholder="enter the keywords" onKeyPress={this.onEnterKey.bind(this)} value={this.props.filters.fullTextSearch} onChange={this.props.onSetFilter}/>
                </div>

                <div className="col-md-1 form-group">
                    <label htmlFor="removeFilterButton" className="form-label">&nbsp;</label>
                    <button id="removeFilterButton" data-toggle="tooltip" title="Remove all filters" type="button" className={`form-control btn btn-danger ${!hasFilters ? 'd-none' : ''}`} onClick={this.removeFilters.bind(this)}>
                        <i className="bi bi-x-square-fill"/>
                    </button>
                </div>

                <div className="col-md-1 form-group">
                    <label htmlFor="filterButton" className="form-label">&nbsp;</label>
                    <button id="filterButton" type="button" className="form-control btn btn-primary mb-2" onClick={this.props.onRunFilter} disabled={!hasFilters}>
                        <i className="bi bi-search"/> Filter
                    </button>
                </div>

                <div className="container-fluid">
                    <a data-toggle="collapse" href="#extraFilters" className="extraFilters" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Extra filters
                    </a>
                    <div className="collapse" id="extraFilters">
                        <div className="card card-body">
                            <div className="row form">
                                <div className="col-md-2 form-group">
                                    <label htmlFor="gender" className="form-label">Gender</label>
                                    <select id="gender" className="selectpicker form-control" value={this.props.filters.gender} onChange={this.props.onSetFilter}>
                                        <option value="">-- All --</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div className="col-md-3 form-group">
                                    <label htmlFor="cityState" className="form-label">City / state <a href="#" data-toggle="tooltip" title="Use commas for more the one expression"><i className="bi bi-question-circle-fill"/></a></label>
                                    <input type="text" className="form-control" id="cityState" placeholder="enter the keywords" value={this.props.filters.cityState} onChange={this.props.onSetFilter} onKeyPress={this.onEnterKey.bind(this)}/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    }
}
export default FilterToolbar;
