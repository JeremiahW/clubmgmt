/**
 * Created by wangji on 11/30/2016.
 */
import React from "react";
import * as URL from "../constants/request-url-constants";
import {Panel, Table, Button} from "react-bootstrap";
import ApplyActivityForm from "./apply-activity-form";
import AppDispatcher from "../actions/apply-activity-action-creator";


export default class ApplyRegistration extends React.Component{
    constructor(props){
        super(props)
       //  this.onSubmit = this.onSubmit.bind(this);
        this.getActivities = this.getActivities.bind(this);
        this.state = {
            "activities": []
        }
    }
    componentDidMount(){
        this.getActivities();
    }
    componentWillUnmount(){

    }
    getActivities(){
        $.ajax({
            url:URL.REQUEST_SHOW_ACTIVITIES,
            type:"POST",
            dataType:"json",
            success:function (response) {
                if(response.result == true){
                    let newState={
                        "activities" : response.data
                    }
                    this.setState(newState);
                    console.log(response.data)
                }
            }.bind(this)
        })
     }

    onSubmit(itemid, activityid){
        if(itemid != "" &&  activityid != ""){
            AppDispatcher.ApplyActivityAction(itemid, activityid);
        }
    }
    render(){
        return <div>
            <ApplyActivityForm />
            {this.state.activities.map(function (item) {
                return <Panel header={item.activity.subject + " " + item.subject} key={item.id}>
                    <Table striped bordered condensed hover>
                        <tbody>
                            <tr>
                                <th>报名开始时间</th>
                                <th>{item.startregdate}</th>
                                <th>报名结束时间</th>
                                <th>{item.endregdate}</th>
                            </tr>
                            <tr>
                                <th>实际人数/允许人数</th>
                                <th>{item.actnumofmember}/{item.numofmember}</th>
                                <th>费用</th>
                                <th>{item.actprice}</th>
                            </tr>
                        </tbody>
                    </Table>
                    <div dangerouslySetInnerHTML={{__html:item.summary}}></div>
                    <Button onClick={this.onSubmit.bind(this, item.id, item.activity.id)} >我要报名</Button>
                </Panel>
            }.bind(this))
        }</div>
    }
}