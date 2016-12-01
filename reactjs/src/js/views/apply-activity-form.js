import React from "react"
import ReactDOM from "react-dom"
import ApplyActivityStore from "../stores/apply-activity-store"
import {Modal, Popover, Tooltip, Overlay, Button} from "react-bootstrap"
import * as URL from "../constants/request-url-constants"

export default class ApplyActivityForm extends React.Component{
    constructor(props){
        super(props)

        this.onClickCallback = this.onClickCallback.bind(this);
        this.close = this.close.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
        this.getMessage = this.getMessage.bind(this);
         this.state = {
            itemid:"",
            activityid:"",
            showModal:false,
            showMessage: false,
            chinese:"",
            gender:"",
            phone:"",
            email:"",
            birthdate:"",
            address:"",
            shenfenzheng:"",
            clothsize:"",
            bloodtype:"",
            emergencycontactname:"",
            emergencycontactphone:"",
            description:"",
            message:"",
        }
    }

    onClickCallback(){
        let newState = {
            itemid: ApplyActivityStore.getActivityItemId(),
            activityid: ApplyActivityStore.getActivityId(),
            showModal: true,
            showMessage:false,
            message:"",
        }
        this.setState(newState);
    }
    close(){
        let newState = {
            showModal: false,
        }
        this.setState(newState);
    }
    getMessage(){
        return (
                    Object.keys(this.state.message).map(function (key) {
                        return <div key={key}>{this.state.message[key]}</div>;
                    }.bind(this))
        );
    }
    onSubmit(e){
         e.preventDefault();
        console.log("ActivityId:" + this.state.activityid + "ItemId: " + this.state.itemid)
        $.ajax({
            url:URL.REQUEST_APPLY_POST,
            type:"POST",
            dataType:"json",
            data:{"form":this.state},
            success:function (response) {
                let newState={
                    "message":response.message,
                    showMessage : true
                }
                this.setState(newState);
                console.log(response.message);
            }.bind(this)
        })

    }
    handleChange(name, event){
        var newState={};
        newState[name] = event.target.value;
        this.setState(newState);
    }


    componentDidMount(){
        ApplyActivityStore.addChangeListener(this.onClickCallback);
    }
    componentWillUnmount(){
        ApplyActivityStore.removeChangeListener(this.onClickCallback);
    }

    render(){
        return <Modal show={this.state.showModal} onHide={this.close}>
                 <Modal.Header closeButton>
                    <Modal.Title>报名活动</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <form method="post" className="form-horizontal" onSubmit={this.onSubmit}>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">姓名</label>
                            <div className="col-sm-10"><input type="text" className="form-control"  onChange={this.handleChange.bind(this, "chinese")}/></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">性别</label>
                            <div className="col-sm-10">
                                <select name="gender" id="gender" className="form-control" onChange={this.handleChange.bind(this, "gender")}>
                                    <option value="">性别</option>
                                    <option value="1" >男</option>
                                    <option value="0">女</option>
                                </select>
                            </div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">联系电话</label>
                            <div className="col-sm-10"><input type="text" className="form-control"   onChange={this.handleChange.bind(this, "phone")} /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">邮箱</label>
                            <div className="col-sm-10"><input type="email" className="form-control"   onChange={this.handleChange.bind(this, "email")}    /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">出生日期</label>
                            <div className="col-sm-10"><input type="date" className="form-control"   onChange={this.handleChange.bind(this, "birthdate")}   /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">住址</label>
                            <div className="col-sm-10"><input type="text" className="form-control"   onChange={this.handleChange.bind(this, "address")}  /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">身份证</label>
                            <div className="col-sm-10"><input type="text" className="form-control"    onChange={this.handleChange.bind(this, "shenfenzheng")} /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">衣服尺码</label>
                            <div className="col-sm-10"><input type="text" className="form-control"   onChange={this.handleChange.bind(this, "clothsize")}  /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">血型</label>
                            <div className="col-sm-10"><input type="text" className="form-control"    onChange={this.handleChange.bind(this, "bloodtype")}  /></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">紧急联系人</label>
                            <div className="col-sm-10"><input type="text" className="form-control"  onChange={this.handleChange.bind(this, "emergencycontactname")}/></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">紧急联系人电话</label>
                            <div className="col-sm-10"><input type="text" className="form-control"  onChange={this.handleChange.bind(this, "emergencycontactphone")}/></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <label className="col-sm-2 control-label">备注</label>
                            <div className="col-sm-10"><input type="text" className="form-control"  onChange={this.handleChange.bind(this, "description")}/></div>
                        </div>
                        <div className="hr-line-dashed"></div>
                        <div className="form-group">
                            <div className="col-sm-4 col-sm-offset-2">
                                 <a href="#" className="btn btn-default" onClick={this.close}>关闭</a> &nbsp;&nbsp;

                                 <button className="btn btn-primary" type="submit" ref="target" >提交</button>
                                <Overlay  show={this.state.showMessage} rootClose={true}
                                          container={this} target={()=>ReactDOM.findDOMNode(this.refs.target)}
                                          onHide={() => this.setState({ showMessage: false })}
                                          placement="top">
                                    <Popover id="overload-top" title="提示信息">    {this.getMessage()}</Popover>
                                </Overlay>
                             </div>
                        </div>
                    </form>
                </Modal.Body>
         </Modal>
    }
}