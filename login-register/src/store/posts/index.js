import axios from "axios";

const store = ({
    state: {
        posts: {}
    },
    getters: {
        posts: state => state.posts,
    },

    mutations: {
        SET_POST(state, data) {
            state.post = data.post
        },
    },
    actions: {
        createPost(commit, data) {
            return new Promise((resolve, reject) => {
              axios.post('/api/posts', data, {
                    headers: {
                        'enctype': 'multipart/form-data'
                    },
                }).then(response => {
                  console.log(response)
                    commit('SET_POST', response.data)
                    resolve(response)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        fetchPosts(commit) {
            return new Promise((resolve, reject) => {
                axios.get('/api/posts').then(response => {
                    console.log(response)
                    commit('SET_POST', response.data)
                    resolve(response)
                }).catch(err => {
                    reject(err)
                })
            })
        }
    },
})
export default store