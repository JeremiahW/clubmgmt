import {Dispatcher} from "flux";
import {RegistrationConstants} from "../constants/registration-search-constants";

class DispatcherRegistrationSearch extends Dispatcher{
    RegistrationSearchAction(id){
        this.dispatch({
            actionType: RegistrationConstants.REGISTRATION_SEARCH,
            id: id
        })
    }
}

const  AppDispatcher = new DispatcherRegistrationSearch();
export default AppDispatcher;
