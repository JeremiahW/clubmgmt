import {Dispatcher} from "flux";
import {ApplyConstants} from "../constants/apply-constants";

class DispatcherApplyActivity extends Dispatcher{
    ApplyActivityAction(actItemId, activityId){
        this.dispatch({
            actionType:ApplyConstants.APPLY_ACTIVITY,
            actItemId:actItemId,
            activityId:activityId
        })
    }
}

const  AppDispatcher = new DispatcherApplyActivity();
export default AppDispatcher;
