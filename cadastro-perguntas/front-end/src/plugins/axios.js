import Vue from 'vue';
import axios from 'axios';

// axios.defaults.baseURL = 'https://curso-vue-dc31b.firebaseio.com/';
//colocando o axios globalmente
Vue.use({
  install(Vue) {
    // Vue.prototype.$http = axios;
    Vue.prototype.$http = axios.create({
      baseURL: 'http://localhost/back-end/public/',
      headers: {
        // Authorization: '123',
        Accept: 'application/json',
      }
    });

    Vue.prototype.$http.interceptors.request.use(
      (config) => {
        // if (config.method == 'post') {
        //   config.method = put;
        // }
        return config;
      },
      (error) => Promise.reject(error)
    );

    /*podemos usar interceptors para converter respostas
    de requisições para o formato que nos for mais conveinente */
    // Vue.prototype.$http.interceptors.response.use(
    //   (res) => {
    //     const array = [];
    //     for (let chave in res.data) {
    //       array.push({ id: chave, ...res.data[chave] });
    //     }

    //     res.data = array;
    //     return res;
    //   },
    //   (error) => Promise.reject(error)
    // );
  },
});
