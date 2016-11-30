import React from "react";
import { Router, Route, Link } from 'react-router'
import * as URL from "../constants/request-url-constants";

export default class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {}
    }

    render() {
        return <div className="ibox-content">
            <ul>
                <li><Link to={URL.FRONTENT_REGISTRATION}>注册会员</Link></li>
                <li><Link to={URL.FRONTENT_SEARCH}>查询注册结果</Link></li>
                <li><Link to={URL.FRONTEND_APPLY}>报名活动</Link></li>
            </ul>
            <div className="ibox-content">
                {this.props.children}
            </div>
        </div>
    }
}