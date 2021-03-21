<template>
  <div class="container-fluid">
    <b-row class="mb-3">
      <b-col cols="8">
        <h3>Perguntas</h3>
      </b-col>
      <b-col>
        <b-button to="lista-dimensoes" variant="light">Dimensões</b-button>
      </b-col>
      <b-col cols="2">
        <b-button to="add-pergunta" variant="primary"
          ><font-awesome-icon icon="plus" />Criar pergunta</b-button
        >
      </b-col>
    </b-row>
    <b-jumbotron id="lista" bg-variant="white">
      <b-row>
        <b-col cols="4">
          <b-form-group
            id="input-group-2"
            label="Dimensão:"
            label-for="id-dimensao"
          >
            <b-form-select
              id="id-dimensao"
              v-model="dimensaoSelecionada"
              :options="dimensoes"
              value-field="idDimensao"
              text-field="descricaoDimensao"
              required
            >
              <template #first>
                <b-form-select-option :value="null">
                  Todas
                </b-form-select-option>
              </template>
            </b-form-select>
          </b-form-group>
        </b-col>
      </b-row>
      <Pergunta
        v-for="pergunta in perguntasFiltradas"
        :key="pergunta.idPergunta"
        :pergunta="pergunta"
      />
    </b-jumbotron>
  </div>
</template>

<script>
import Pergunta from "./Pergunta";
export default {
  components: { Pergunta },
  data() {
    return {
      mensagens: [],
      perguntas: [],
      dimensoes: [],
      dimensaoSelecionada: null,
    };
  },
  created() {
    this.obterDados();
  },
  methods: {
    obterDados() {
      this.perguntas = [];
      this.$http("/dimensoes").then((res) => {
        this.dimensoes = res.data;
        this.$http("/perguntas").then((res) => {
          this.perguntas = res.data;
        });
      });
    },
    obterPerguntas() {
      this.perguntas = [];
      this.$http("/perguntas").then((res) => {
        this.perguntas = res.data;
      });
    },
  },
  computed: {
    perguntasFiltradas() {
      return this.perguntas.filter((pergunta) => {
        if (this.dimensaoSelecionada != null) {
          return pergunta.idDimensao == this.dimensaoSelecionada;
        } else {
          return pergunta;
        }
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
