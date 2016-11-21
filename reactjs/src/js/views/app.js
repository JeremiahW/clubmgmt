import React from "react";
import { Router, Route, Link } from 'react-router'


export default class App extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return <div className="row">
            <ul>
                <li><Link to="/reg">注册活动</Link></li>
                <li><Link to="/search">查询注册结果</Link></li>
            </ul>
            {this.props.children}
        </div>
    }
}