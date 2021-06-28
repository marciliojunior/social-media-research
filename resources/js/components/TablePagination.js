import React from 'react';

const TablePagination = (props) =>
{
    const page = props.current_page ? props.current_page : 0;
    const total = props.last_page ? props.last_page : 0;

    //Build the pagination range
    function pagination(current, last)
    {
        const delta = 2,
            left = current - delta,
            right = current + delta + 1,
            range = [],
            rangeWithDots = [];
        let l = null;

        for (let i = 1; i <= last; i++) {
            if (i === 1 || i === last || i >= left && i < right) {
                range.push(i);
            }
        }

        for (let i of range) {
            if (l) {
                if (i - l === 2) {
                    rangeWithDots.push(l + 1);
                } else if (i - l !== 1) {
                    rangeWithDots.push(0);
                }
            }
            rangeWithDots.push(i);
            l = i;
        }

        return rangeWithDots;
    }

    //Set the current page by number
    function setCurrentPage(newPage)
    {
        props.onSetPagination('page', newPage);
    }

    //Advance to the next page
    function nextPage()
    {
        props.onSetPagination('page', page + 1);
    }

    //Back to the previous page
    function prevPage()
    {
        props.onSetPagination('page', page - 1);
    }

    //Define the number of rows per page
    function setRowsPerPage(val)
    {
        props.onSetPagination('limit', val);
    }

    //---

    const range = pagination(page, total);
    const pages = [];
    const pageSizes = [10, 50, 100, 500];

    range.map((i, idx) => {
        if (i === 0)
            pages.push(<li key={idx} className="page-item"><a className="page-link">...</a></li>)
        else
            pages.push(<li key={idx} className={`page-item ${page === i && 'active'}`}>
                <a className="page-link" href="#" onClick={() => setCurrentPage(i)}>{i}</a>
            </li>)
    });

    return (
        <nav>
            <div className="form-inline float-left">
                <label htmlFor="rowsPerPage" className="mr-1">rows per page</label>
                <select id="rowsPerPage" className="selectpicker form-control mr-2" onChange={(e) => setRowsPerPage(e.currentTarget.value) } value={props.per_page}>
                    {pageSizes.map((i, id) => <option key={id} value={i}>{i}</option>)}
                </select>
            </div>

            <ul className="pagination float-left">
                <li className={`page-item ${page === 1 && 'disabled'}`}>
                    <a className="page-link" href="#" tabIndex="-1" onClick={prevPage.bind(this)}>Previous</a>
                </li>

                {pages}

                <li className={`page-item ${page === total && 'disabled'}`}>
                    <a className="page-link" href="#" onClick={nextPage.bind(this)}>Next</a>
                </li>
            </ul>

            <div className="float-right mt-2 font-weight-bold">
                <h5><span className={"badge badge-" + (props.total > 0 ? 'success' : 'danger')}>{props.total} Records</span></h5>
            </div>
        </nav>
    );
}
export default TablePagination;
