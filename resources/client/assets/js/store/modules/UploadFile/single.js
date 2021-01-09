function initialState() {
    return {
        item: {
            id: null,
            user: null,
            name_file: null,
            url_file: null,
            size_file: null,
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
            if (! _.isEmpty(params.user)) {
                params.user_id = params.user.id
            }

            axios.post('/api/v1/upload', params)
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
            if (! _.isEmpty(params.user)) {
                params.user_id = params.user.id
            }

            axios.put('/api/v1/upload/' + params.id, params)
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
        axios.get('/api/v1/upload/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })

        dispatch('fetchCompaniesAll')
    },
    fetchCompaniesAll({ commit }) {
        axios.get('/api/v1/upload')
            .then(response => {
                commit('setCompaniesAll', response.data.data)
            })
    },
    setUser({ commit }, value) {
        commit('setUser', value)
    },
    setName_file({ commit }, value) {
        commit('setName_file', value)
    },
    setUrl_file({ commit }, value) {
        commit('setUrl_file', value)
    },
    setSize_file({ commit }, value) {
        commit('setSize_file', value)
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setUser(state, value) {
        state.item.user = value
    },
    setName_file(state, value) {
        state.item.name_file = value
    },
    setUrl_file(state, value) {
        state.item.url_file = value
    },
    setSize_file(state, value) {
        state.item.size_file = value
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
