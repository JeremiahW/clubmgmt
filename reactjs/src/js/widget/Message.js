/**
 * Created by wangji on 11/22/2016.
 */
import React from "react";

export default class Message extends React.Component{
    constructor(props){
        super(props)

        this.getMessage = this.getMessage.bind(this);
    }

    getMessage(){
        if(this.props.message != ""){
            return ( <div className="form-group">
                <div className="col-sm-4 col-sm-offset-2">
                    <div className="alert alert-warning">
                        <a className="close" data-dismiss="alert">×</a>
                        { this.props.message}
                    </div>
                </div>
            </div>)
        }
        else{
            return "";
        }
    }

    render(){
        return <div>{this.getMessage()}</div>
    }
}