import Vue from 'vue'
import Vuex from 'vuex'

import RolesIndex from './modules/Roles'
import RolesSingle from './modules/Roles/single'
import UsersIndex from './modules/Users'
import UsersSingle from './modules/Users/single'
import CompaniesIndex from './modules/Companies'
import CompaniesSingle from './modules/Companies/single'
import EmployeesIndex from './modules/Employees'
import EmployeesSingle from './modules/Employees/single'
import GroupIndex from './modules/Group'
import GroupSingle from './modules/Group/single'
import UploadFileIndex from './modules/UploadFile'
import UploadFileSingle from './modules/UploadFile/single'
import UserFileIndex from './modules/UserFile'
import UserFileSingle from './modules/UserFile/single'

import Alert from './modules/alert'
import ChangePassword from './modules/change_password'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
    modules: {
        Alert,
        ChangePassword,
        RolesIndex,
        RolesSingle,
        UsersIndex,
        UsersSingle,
        CompaniesIndex,
        CompaniesSingle,
        EmployeesIndex,
        EmployeesSingle,
        GroupIndex,
        GroupSingle,
        UploadFileIndex,
        UploadFileSingle,
        UserFileIndex,
        UserFileSingle


    },
    strict: debug,
})
