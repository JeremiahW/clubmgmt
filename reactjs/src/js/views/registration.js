import React from "react";
import AppDispatcher from "../actions/registration-action-creator";
import * as RequestUrlConstants from "../constants/request-url-constants";
import Message from "../widget/Message";

export default class Registration extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            message:"",
            branches:[],
            username:"",
            email:"",
            chinese:"",
            phone:"",
            shenfenzheng:"",
            address:"",
            clothsize:"",
            bloodtype:"",
            emergencycontactname:"",
            emergencycontactphone:"",
            branchid:"",
            gender:"",
        }
        this.getBranch = this.getBranch.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }
    getBranch(){
        $.ajax({
           url:RequestUrlConstants.REQUEST_REGISTRATION_GETBRANCH,
            type:"POST",
            dataType:"json",
        }).done((result)=>{
            if(result.result==true){
                console.log(result.data);
                let newState = {
                    data:"",
                    branches:result.data,
                }
                this.setState(newState);
            }
        }).fail((result)=>{
            console.log("request fail")
        });
    }
    onSubmit(e){
        e.preventDefault();
        $.ajax({
           url:RequestUrlConstants.REQUEST_REGISTRATION_POST,
            type:"POST",
            dataType:"json",
            data:{"form":this.state},
            success:function (result) {
                if(result.result == true){
                    //TODO 提示注册成功

                }
                else{
                    let newState={
                        "message": result.data,
                    }
                    this.setState(newState);
                }
            }.bind(this)
        })

    }
    handleChange(name, event){
        var newState = {};
        newState[name] = event.target.value;
         this.setState(newState);
    }
    componentDidMount(){
        this.getBranch();

     }
    componentWillUnmount(){

    }

    render(){
        return <form method="post" className="form-horizontal" onSubmit={this.onSubmit}>
                    <Message message={this.state.message} />
                    <div className="form-group">
                        <label className="col-sm-2 control-label">选择分部</label>
                        <div className="col-sm-10">
                            <select name="branch" id="branch" className="form-control" onChange={this.handleChange.bind(this, "branchid")}>
                                <option value="">请选择经常参加活动的分部</option>
                                {
                                    this.state.branches.map(function (item) {
                                         return <option key={item.id} value={item.id}>{item.subject}</option>
                                    })
                                }
                            </select>
                        </div>
                    </div>
                    <div className="hr-line-dashed"></div>
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
                        <div className="col-sm-4 col-sm-offset-2">
                            <button className="btn btn-white" type="submit">Cancel</button>
                            <button className="btn btn-primary" type="submit">Save changes</button>
                            <input type="hidden" name="id" id="id"  className="form-control"/>
                         </div>
                    </div>
            </form>

    }
}