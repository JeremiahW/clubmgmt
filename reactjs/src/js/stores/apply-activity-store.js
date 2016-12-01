/**
 * Created by wangji on 12/1/2016.
 */
import AppDispatcher from "../actions/apply-activity-action-creator";
import {ApplyConstants} from "../constants/apply-constants";
import {EventEmitter} from "events";

var activityItemId = "";
var activityId = "";

class ApplyActivityStoreClass extends EventEmitter {
    addChangeListener(callback){
        this.on("click", callback)
    }

    removeChangeListener(callback){
        this.removeListener("click", callback)
    }
    getActivityItemId(){
        return activityItemId;
    }
    getActivityId(){
        return activityId;
    }
}

const ApplyActivityStore = new ApplyActivityStoreClass();
export default ApplyActivityStore;

AppDispatcher.register((request)=>{
    switch (request.actionType){
        case ApplyConstants.APPLY_ACTIVITY:
            activityItemId = request.actItemId;
            activityId = request.activityId;
            ApplyActivityStore.emit("click");
            break;
    }
})