import React from "react";
import RegistrationSearchStore from "../stores/registration-search-store";

export default class RegistrationSearchResult extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            //TODO 设置初始值
            "data":"",
        }
        this.onChangeCallBack = this.onChangeCallBack.bind(this);
    }
    onChangeCallBack(){
        var newState = [];
        newState["data"] = RegistrationSearchStore.getResult();
        this.setState(newState);
       // console.log("RegistrationSearchResult:" + this.state.data);
    }
    componentDidMount() {
       RegistrationSearchStore.addChangeListener(this.onChangeCallBack);
    }
    componentWillUnmount() {
       RegistrationSearchStore.removeChangeListener(this.onChangeCallBack);
    }
    render(){
        var rows = [];
        for(var i=0;i<this.state.data.length;i++){

            rows.push(<ResultRow chinese={this.state.data[i].chinese}
                                 isapproval={this.state.data[i].isapproval}
                                  activityName={this.state.data[i].activityItem.subject}
                                 key={i}/>);
        }

        return (<div className="row">
                <table className="table">
                    {<ResultHeader />}
                    <tbody>
                        {rows}
                    </tbody>
                </table>
                </div>)
    }
}

class ResultRow extends React.Component{
    constructor(props){
        super(props)
    }
    render(){
        return <tr>
            <td>{this.props.activityName}</td>
            <td>{this.props.chinese}</td>
            <td>{this.props.isapproval}</td>
        </tr>
    }
}

class ResultHeader extends React.Component{
    constructor(props){
        super(props)
    }

    render(){
        return <thead>
            <tr>
                <th>活动名称</th>
                <th>姓名</th>

                <th>报名状态</th>
            </tr>
        </thead>
    }
}