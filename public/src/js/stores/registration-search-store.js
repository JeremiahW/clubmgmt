import AppDispatcher from "../actions/registration-search-action-creator";
import {RegistrationConstants} from "../constants/registration-search-constants";
import {EventEmitter} from "events";


var _result;

class RegistrationSearchStoreClass extends EventEmitter{
    addChangeListener(callback) {
        this.on("search", callback);
    }

    removeChangeListener(callback) {
        this.removeListener("search", callback);
    }

    getResult () {
    //这里返回数据的结果
        console.log("getResult() result:" + _result);
        return _result;
    }
}

const RegistrationSearchStore = new RegistrationSearchStoreClass();

AppDispatcher.register((action)=>{
    switch (action.actionType){
        case RegistrationConstants.REGISTRATION_SEARCH:
            console.log("action is fired, result:" + action.id);
            _result = action.id; //这里使用Ajax将结果给全局变量.
            RegistrationSearchStore.emit("search");
            break;
    }
})



export default RegistrationSearchStore;