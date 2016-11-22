import AppDispatcher from "../actions/registration-action-creator";
import {RegistrationConstants} from "../constants/registration-constrants";
import * as RequestUrlConstants from "../constants/request-url-constants";
import {EventEmitter} from "events";

var _branches = [];
var _data = [];

class RegistrationStoreClass extends EventEmitter{
    addChangeListener(callback){
      this.on("getBranch", callback);
      this.on("submit", callback);
    }

    removeChangeListener(callback){
        this.removeListener("getBranch", callback);
        this.removeListener("submit", callback);
    }

    getBranch(){
        return _branches;
    }

    getSubmitResult(){
        return _data;
    }
}

const RegistrationStore = new RegistrationStoreClass();
export default RegistrationStore;


AppDispatcher.register((request)=>{
    switch(request.actionType){
        case RegistrationConstants.GET_BRANCHES:
            RegistrationStore.emit("getBranch");
            break;
        case RegistrationConstants.SUBMIT_REGISTRATION:
            RegistrationStore.emit("submit");
            break;
    }

})