import React from "react";
import RegistrationSearchStore from "../stores/registration-search-store";

export default class RegistrationSearchResult extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            //TODO 设置初始值
            "id":"empty",
        }
        this.onChangeCallBack = this.onChangeCallBack.bind(this);
    }
    onChangeCallBack(){
        //this.setState();

        var newState = [];
        newState["id"] = RegistrationSearchStore.getResult();
        this.setState(newState);
    }
    componentDidMount() {
       RegistrationSearchStore.addChangeListener(this.onChangeCallBack);
    }
    componentWillUnmount() {
       RegistrationSearchStore.removeChangeListener(this.onChangeCallBack);
    }
    render(){
        return (<div className="row">{this.state.id}</div>)
    }
}