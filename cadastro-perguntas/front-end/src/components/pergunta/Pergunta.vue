<template>
  <b-row class="mb-2">
    <b-col>
      <b-form-checkbox switch size="lg" v-model="ativa"> </b-form-checkbox>
    </b-col>
    <b-col class="bordered text-center" cols="2">{{
      pergunta.descricaoDimensao
    }}</b-col>
    <b-col class="bordered" cols="6">{{ pergunta.textoPergunta }}</b-col>
    <b-col class="bordered text-right" cols="3">
      <b-button
        variant="primary"
        size="sm"
        :to="{ path: `edit-pergunta/${pergunta.idPergunta}` }"
        >Editar</b-button
      >
      <b-button variant="danger" size="sm" @click="deletePergunta"
        >Excluir</b-button
      >
    </b-col>
  </b-row>
</template>

<script>
export default {
  props: {
    pergunta: {
      type: Object,
      required: true,
    },
  },
  data: function () {
    return {
      ativa: this.pergunta.ativaPergunta == "1",
      path: `perguntas/${this.pergunta.idPergunta}`,
    };
  },
  methods: {
    deletePergunta() {
      this.$swal({
        title: `Você deseja realmente excluir a pergunta: <br> "${this.pergunta.textoPergunta}"`,
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Sim`,
        denyButtonText: `Não`,
        cancelButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          this.$http
            .delete(this.path)
            .then((res) => {
              this.$swal(
                "Sucesso",
                "Pergunta excluída com sucesso!",
                "success"
              );
              this.$parent.obterPerguntas();
            })
            .catch((error) => {
              this.$swal(
                error.response.data.status,
                error.response.data.mensagem,
                "error"
              );
            });
        }
      });
    },
  },
  watch: {
    ativa: function (novaAtiva) {
      var ativaPassar = novaAtiva ? "1" : "0";
      var data = JSON.parse(`{ "ativaPergunta": ${ativaPassar} }`);
      this.$http
        .put(this.path, data)
        .then((res) => {
          this.$swal(
            "Status alterado",
            "Status da pergunta alterado com sucesso!",
            "success"
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
  },
};
</script>

<style>
.bordered {
  border: 1px solid black;
}
</style>