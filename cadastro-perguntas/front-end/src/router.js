import Vue from 'vue'
import Router from 'vue-router'

import ListaPerguntas from './components/pergunta/ListaPerguntas'
import ListaDimensoes from './components/dimensao/ListaDimensoes'
import CriaEditaDimensao from './components/dimensao/CriaEditaDimensao'
import CriaEditaPergunta from './components/pergunta/CriaEditaPergunta'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        { path: '/', component: ListaPerguntas },
        { path: '/lista-perguntas', component: ListaPerguntas },
        { path: '/lista-dimensoes', component: ListaDimensoes },
        { path: '/add-dimensao', component: CriaEditaDimensao },
        { path: '/edit-dimensao/:id', component: CriaEditaDimensao },
        { path: '/add-pergunta', component: CriaEditaPergunta },
        { path: '/edit-pergunta/:id', component: CriaEditaPergunta },
    ]
})