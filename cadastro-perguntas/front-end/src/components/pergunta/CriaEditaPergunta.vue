<template>
  <div class="container-fluid">
    <b-row class="mb-3">
      <b-col cols="12">
        <h3>{{ this.id != null ? "Editar pergunta" : "Criar pergunta" }}</h3>
      </b-col>
    </b-row>
    <b-jumbotron id="lista" bg-variant="white">
      <b-form @submit="salvarEditarPergunta">
        <b-form-group
          id="input-group-1"
          label="Pergunta:"
          label-for="texto-pergunta"
        >
          <b-form-input
            id="texto-pergunta"
            v-model="form.textoPergunta"
            placeholder="Informe o texto da pergunta"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="input-group-2"
          label="Dimensão:"
          label-for="id-dimensao"
        >
          <b-form-select
            id="id-dimensao"
            v-model="form.idDimensao"
            :options="dimensoes"
            value-field="idDimensao"
            text-field="descricaoDimensao"
            required
          >
            <template #first>
              <b-form-select-option :value="null" disabled>
                Selecione
              </b-form-select-option>
            </template>
          </b-form-select>
        </b-form-group>
        <b-button type="submit" variant="success">Salvar</b-button>
        <b-button to="../lista-perguntas" type="reset" variant="light"
          >Cancelar</b-button
        >
      </b-form>
    </b-jumbotron>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mensagens: [],
      dimensoes: [],
      pergunta: [],
      form: {
        textoPergunta: "",
        idDimensao: null,
      },
      id: null,
    };
  },
  created() {
    if (this.$route.params.id != null) {
      this.id = this.$route.params.id;
    }
    this.obterDimensoes();
    // this.obterDimensao();
  },
  methods: {
    obterDimensoes() {
      /*se o método não for passado, 
      o axios automaticamente faz uma requisição 
      get*/
      this.$http(`/dimensoes`).then((res) => {
        this.dimensoes = res.data;
        if (this.$route.params.id != null) {
          this.id = this.$route.params.id;
          this.obterPergunta();
        }
      });
    },
    salvarEditarPergunta(event) {
      event.preventDefault();
      const metodo = this.id ? "put" : "post";
      const finalUrl = this.id ? `/${this.id}` : "";
      this.$http[metodo](`/perguntas${finalUrl}`, this.form)
        .then((res) => {
          console.log(res);
          this.$swal("Sucesso!", "Pergunta salva com sucesso!", "success").then(
            () => {
              this.$router.push("../lista-perguntas");
            }
          );
        })
        .catch((error) => {
          this.$swal(
            error.response.data.status,
            error.response.data.mensagem,
            "error"
          );
        });
    },
    obterPergunta() {
      this.$http(`/perguntas/${this.id}`).then((res) => {
        this.pergunta = res.data;
        this.form = { 
          'textoPergunta': this.pergunta.textoPergunta,
          'idDimensao': this.pergunta.idDimensao
         };
        console.log(JSON.stringify(this.form));
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
