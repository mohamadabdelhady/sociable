import React from 'react';
import ReactDOM from 'react-dom';
import "./post.css"
function Example() {
    return (
        <div className="container">
            {/*<div className="row justify-content-center">*/}
            {/*    <div className="col-lg-12">*/}
            {/*        <div className="card">*/}

            {/*            <div className="card-body">*/}

            {/*            </div>*/}
            {/*        </div>*/}
            {/*    </div>*/}
            {/*</div>*/}
            <div className="card">
            <div className="row ">
                <div className="col-6">
                    <p>username</p>
                </div>
                <div className="col-6 " id="user">
                    <p>{{$query['created_at']}}</p>
                </div>
            </div>
                <div className="row content">
                    <div className="col-12 ">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
                <div className="row foot">

                    <div className="col-4 m-2">
                        <a href="#" className="mybtn btn"><span>Comments</span></a>
                    </div>
                    <div className="col-2"></div>
                    <div className="col-2">
                        <button className="btn mybtn m-2"><img src="/likes_icon.png"/><span>0</span></button>

                    </div>
                    <div className="col-2">
                        <button className="btn mybtn m-1"><img src="/dislike_icon.png"/><span>0</span></button>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
