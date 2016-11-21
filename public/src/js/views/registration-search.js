import React from "react";
import AppDispatcher from "../actions/registration-search-action-creator";
import RegistrationSearchResult from "../views/registration-search-result";

// import RegistrationSearchStore from "../stores/registration-search-store";

class RegistrationSearch extends React.Component {
    constructor(props){
     super(props);
       this.state={
           id:"",
       }
   }
   handleChange(name, event){
       var newState = {};
       newState[name] = event.target.value;
       this.setState(newState);
       // AppDispatcher.RegistrationSearchAction(this.state.id);
   }
   onSubmit(e){
       e.preventDefault();
       if(this.state.id != ""){
           AppDispatcher.RegistrationSearchAction(this.state.id);
       }

   }
    render(){
        return (<div className="row">
            <form onSubmit={this.onSubmit.bind(this)}  >
                <div className="form-group">
                    <label htmlFor="txtId">身份证:</label>
                    <input type="text" id="txtId" name="txtId" className="form-control" onChange={this.handleChange.bind(this, "id")}  />
                    <input type="submit" className="btn btn-primary" value="查询"/>
                </div>
                <div className="form-group">
                 <RegistrationSearchResult/>
                </div>
            </form>
         </div>);
    }
};

export default RegistrationSearch;