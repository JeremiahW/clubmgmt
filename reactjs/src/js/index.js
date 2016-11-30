
import React from "react";
import ReactDom from "react-dom";
import style from "bootstrap/dist/css/bootstrap.css";
import RegistrationSearch from "./views/registration-search";
import Registration from "./views/registration";
import {Router, Route, Link, browserHistory} from 'react-router'
import App from "./views/app";
import * as URL from "./constants/request-url-constants";
import ApplyRegistration from "./views/apply-activity";

//var React = require("react");
//var ReactDom = require("react-dom");




ReactDom.render((
    <Router history={browserHistory}>
        <Route path={URL.FRONTEND_DEFAULT} component={App} >
            <Route path={URL.FRONTENT_REGISTRATION} component={Registration}/>
            <Route path={URL.FRONTENT_SEARCH} component={RegistrationSearch} />
            <Route path={URL.FRONTEND_APPLY} component={ApplyRegistration} />
         </Route>
    </Router>

),document.getElementById("root"));

/*

ReactDom.render(
   <RegistrationSearch />, document.getElementById("root")
);

*/
