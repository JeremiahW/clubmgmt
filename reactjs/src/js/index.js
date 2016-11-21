
import React from "react";
import ReactDom from "react-dom";
import style from "bootstrap/dist/css/bootstrap.css";
import RegistrationSearch from "./views/registration-search";
import Registration from "./views/registration";
import {Router, Route, Link, browserHistory} from 'react-router'

//var React = require("react");
//var ReactDom = require("react-dom");

/*
class App extends React.Component{
    render() {
        return <div>
            {this.props.children}
        </div>
    }
}


ReactDom.render((
    <Router history={browserHistory}>
        <Route path="/" component={App} >
            <Route path="/reg" component={Registration}/>
            <Route path="/search" component={RegistrationSearch} />
         </Route>
    </Router>

),document.getElementById("root"));
 */

ReactDom.render(
   <RegistrationSearch />, document.getElementById("root")
);


