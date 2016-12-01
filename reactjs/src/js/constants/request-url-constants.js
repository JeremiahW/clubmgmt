/**
 * Created by wangji on 11/21/2016.
 */
import keyMirror from "keymirror";

var _ROOT = "/clubmgmt/public/index.php/";

export const REQUEST_SEARCH_REGISTRATION = _ROOT + "frontend/member/searchyById";
export const REQUEST_REGISTRATION_GETBRANCH = _ROOT +  "frontend/branch/getBranches";
export const REQUEST_REGISTRATION_POST = _ROOT +  "frontend/member/addMember";
export const REQUEST_SHOW_ACTIVITIES = _ROOT + "frontend/activity/get";
export const REQUEST_APPLY_POST = _ROOT + "frontend/activity/apply";


var _ROOT_FRONTENT = "/clubmgmt/reactjs/build/html/";
export const FRONTENT_REGISTRATION = _ROOT_FRONTENT + "register";
export const FRONTENT_SEARCH = _ROOT_FRONTENT + "search";
export const FRONTEND_DEFAULT =  _ROOT_FRONTENT;
export const FRONTEND_APPLY = _ROOT_FRONTENT  + "apply";
