import React from 'react';
import TablePagination from "./TablePagination";
import $ from "jquery";

class Table extends React.Component
{
    enableTooltip() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    }

    //Create the content of list name column
    listsColumn(lists, p)
    {
        let text = <span className="badge badge-light">no lists</span>;

        if(lists && lists.length){
            if(lists.length <= 2){
                text = '';
                lists.map((l, i) => {
                    if(i > 0)
                        text += ', '
                    text += l.name;
                })
            }
            else {
                let lis = '';
                lists.map((l, i) => {
                    if(i > 0)
                        lis += "<br/>";
                    lis += l.name;
                })
                text = <span className="badge badge-pill badge-primary" data-html="true" data-toggle="tooltip" title={lis}>{lists.length} lists</span>
            }
        }
        return text;
    }

    render()
    {
        this.enableTooltip();
        return <div>
            <TablePagination {...this.props}/>
            <table className="table table-bordered">
                <thead className="thead-dark table-striped">
                <tr>
                    <th scope="col" className="text-center">Date Posted</th>
                    <th scope="col" className="text-center">Social Network</th>
                    <th scope="col">Post content</th>
                    <th scope="col">Person Name</th>
                    <th scope="col">City / State</th>
                    <th scope="col" className="text-center">List Names</th>
                </tr>
                </thead>
                <tbody>
                    {this.props.data && this.props.data.map((rec, idx) =>
                        <tr key={idx}>
                            <td className="text-center">
                                {rec.post_date}
                            </td>
                            <td className="text-center">
                                <i className={'bi bi-' + rec.account.social_network.name.toLocaleLowerCase()}/> {rec.account.social_network.name}
                            </td>
                            <td>
                                <div className="resume"><a href={'/post/' + rec.id} target="_blank">{rec.content}</a></div>
                            </td>
                            <td>
                                {rec.account.person.name}
                                &nbsp;<span className="badge badge-secondary">{rec.account.person.gender === 'M' ? 'Male' : 'Female'}</span>
                            </td>
                            <td>
                                {rec.account.person.city} / {rec.account.person.state}
                            </td>
                            <td className="listsColumn text-center">
                                {this.listsColumn(rec.account.person.lists, rec)}
                            </td>
                        </tr>
                    )}
                </tbody>
            </table>
            <TablePagination {...this.props}/>
        </div>
    }
}
export default Table;
