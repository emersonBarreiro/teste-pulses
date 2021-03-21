<template>
  <div class="container-fluid">
    <b-row class="mb-3">
      <b-col cols="10">
        <h3>Dimensões</h3>
      </b-col>
      <b-col cols="2">
        <b-button to="add-dimensao" variant="primary"
          ><font-awesome-icon icon="plus" />Criar dimensão</b-button
        >
      </b-col>
    </b-row>
    <b-jumbotron id="lista" bg-variant="white">
      <Dimensao
        v-for="dimensao in dimensoes"
        :key="dimensao.idDimensao"
        :dimensao="dimensao"
      />
    </b-jumbotron>
  </div>
</template>

<script>
import Dimensao from "./Dimensao";
export default {
  components: { Dimensao },
  data() {
    return {
      mensagens: [],
      dimensoes: [],
    };
  },
  created() {
    this.obterDimensoes();
  },
  methods: {
    obterDimensoes() {
      this.dimensoes = [];
      this.$http("/dimensoes").then((res) => {
        this.dimensoes = res.data;
        this.dimensoes.sort((a, b) => 
          a.descricaoDimensao.localeCompare(b.descricaoDimensao)
        );
      });
    },
  },
};
</script>

<style>
#lista {
  height: 500px;
  box-shadow: -1px 3px 3px black;
}
</style>
