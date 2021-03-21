<template>
  <b-row class="mb-2">
    <b-col class="bordered" cols="9">{{ dimensao.descricaoDimensao }}</b-col>
    <b-col class="bordered text-right" cols="3">
      <b-button
        :to="{ path: `edit-dimensao/${dimensao.idDimensao}` }"
        variant="primary"
        size="sm"
        >Editar</b-button
      >
      <b-button variant="danger" size="sm" @click="deleteDimensao"
        >Excluir</b-button
      >
    </b-col>
  </b-row>
</template>

<script>
export default {
  props: {
    dimensao: {
      type: Object,
      required: true,
    },
  },
  data: function () {
    return {
      path: `dimensoes/${this.dimensao.idDimensao}`,
    };
  },
  methods: {
    deleteDimensao() {
      this.$swal({
        title: `Você deseja realmente excluir a dimensão: <br> "${this.dimensao.descricaoDimensao}"`,
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
                "Dimensão excluída com sucesso!",
                "success"
              );
              this.$parent.obterDimensoes();
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
};
</script>

<style>
.bordered {
  border: 1px solid black;
}
</style>