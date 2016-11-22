import React from "react";
import { Router, Route, Link } from 'react-router'


export default class App extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return <div className="ibox-content">
            <ul>
                <li><Link to="/reg">注册活动</Link></li>
                <li><Link to="/search">查询注册结果</Link></li>
            </ul>
            <div className="ibox-content">
                {this.props.children}
            </div>
        </div>
    }
}