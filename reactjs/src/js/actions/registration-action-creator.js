import {Dispatcher} from "flux";
import {RegistrationConstants} from "../constants/registration-constrants";

class DispatcherRegistration extends Dispatcher{
    GetBranchAction(data){
        this.dispatch({
            actionType:RegistrationConstants.GET_BRANCHES,
            data : data
        })
    }
    SubmitRegistrationAction(data){
        this.dispatch({
            actionType:RegistrationConstants.SUBMIT_REGISTRATION,
            data : data
        })
    }
}

const AppDispatcher = new DispatcherRegistration();
export default AppDispatcher;