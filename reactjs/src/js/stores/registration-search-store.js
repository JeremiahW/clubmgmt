import AppDispatcher from "../actions/registration-search-action-creator";
import {RegistrationConstants} from "../constants/registration-search-constants";
import * as RequestUrlConstants from "../constants/request-url-constants";
import {EventEmitter} from "events";


var _result = [];

class RegistrationSearchStoreClass extends EventEmitter{
    addChangeListener(callback) {
        this.on("search", callback);
    }

    removeChangeListener(callback) {
        this.removeListener("search", callback);
    }

    getResult () {
    //这里返回数据的结果
        return _result;
    }
}

const RegistrationSearchStore = new RegistrationSearchStoreClass();

AppDispatcher.register((action)=>{
    switch (action.actionType){
        case RegistrationConstants.REGISTRATION_SEARCH:
             $.ajax({
                url:RequestUrlConstants.REQUEST_SEARCH_REGISTRATION,
                type:"POST",
                dataType:"json",
                data:{'id':action.id},
                success:function (result) {
                    console.log("shenfenzheng:"+result.shenfenzheng);
                    if(result.result == true){
                        _result = result.data;
                        RegistrationSearchStore.emit("search");
                    }
                }
            });
            break;
    }
})



export default RegistrationSearchStore;