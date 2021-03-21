<template>
  <div class="container-fluid">
    <b-row class="mb-3">
      <b-col cols="12">
        <h3>{{ this.id != null ? "Editar dimensão" : "Criar dimensão" }}</h3>
      </b-col>
    </b-row>
    <b-jumbotron id="lista" bg-variant="white">
      <b-form @submit="salvarEditarDimensao">
        <b-form-group
          id="input-group-1"
          label="Dimensão:"
          label-for="texto-dimensao"
        >
          <b-form-input
            id="texto-dimensao"
            v-model="form.descricaoDimensao"
            placeholder="Informe a descrição da dimensão"
            required
          ></b-form-input>
        </b-form-group>
        <b-button type="submit" variant="success">Salvar</b-button>
        <b-button to="../lista-dimensoes" type="reset" variant="light"
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
      dimensao: [],
      form: {
        descricaoDimensao: "",
      },
      id: null,
    };
  },
  created() {
    if (this.$route.params.id != null) {
      this.id = this.$route.params.id;
      this.obterDimensao();
    }
  },
  methods: {
    obterDimensao() {
      this.$http(`/dimensoes/${this.id}`).then((res) => {
        this.dimensao = res.data;
        this.form.descricaoDimensao = this.dimensao.descricaoDimensao;
        console.log(JSON.stringify(this.form));
      });
    },
    salvarEditarDimensao(event) {
      event.preventDefault();
      const metodo = this.id ? "put" : "post";
      const finalUrl = this.id ? `/${this.id}` : "";
      this.$http[metodo](`/dimensoes${finalUrl}`, this.form)
        .then((res) => {
          console.log(res);
          this.$swal("Sucesso!", "Dimensão salva com sucesso!", "success").then(
            () => {
              this.$router.push('../lista-dimensoes');
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
    limparTela() {
      this.form.descricaoDimensao = "";
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
