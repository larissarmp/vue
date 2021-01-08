function initialState() {
    return {
        item: {
            id: null,
            group: null,
            name: null,
            email: null,
        },
        companiesAll: [],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    companiesAll: state => state.companiesAll,
}

const actions = {
    storeData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = _.cloneDeep(state.item)
            if (! _.isEmpty(params.group)) {
                params.group_id = params.group.id
            }

            axios.post('/api/v1/user-file', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = _.cloneDeep(state.item)
            if (! _.isEmpty(params.group)) {
                params.group_id = params.group.id
            }

            axios.put('/api/v1/user-file/' + params.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors  = error.response.data.errors

                    dispatch(
                        'Alert/setAlert',
                        { message: message, errors: errors, color: 'danger' },
                        { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        axios.get('/api/v1/user-file/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchCompaniesAll')
    },
    fetchCompaniesAll({ commit }) {
        axios.get('/api/v1/user-file')
            .then(response => {
                commit('setCompaniesAll', response.data.data)
            })
    },
    setGroup({ commit }, value) {
        commit('setGroup', value)
    },
    setName({ commit }, value) {
        commit('setName', value)
    },
    setEmail({ commit }, value) {
        commit('setEmail', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setGroup(state, value) {
        state.item.group = value
    },
    setName(state, value) {
        state.item.name = value
    },
    setEmail(state, value) {
        state.item.email = value
    },
    setCompaniesAll(state, value) {
        state.companiesAll = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}
