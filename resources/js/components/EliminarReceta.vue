<template>
    <input
        type="submit"
        class="btn btn-primary btn-sm d-block w-100"
        value="Eliminar"
        @click="eliminarReceta"
    />
</template>

<script>
export default {
    props: ["recetaId"],

    methods: {
        eliminarReceta() {
            this.$swal({
                title: "¿Deseas eliminar la receta?",
                text: "No podrás deshacer este paso",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No"
            }).then(result => {
                if (result.isConfirmed) {
                    const params = {
                        if: this.recetaId
                    };
                    //Enviar peticion al servidor
                    axios
                        .post(`/recetas/${this.recetaId}`, {
                            params,
                            _method: "delete"
                        })
                        .then(res => {
                            this.$swal({
                                title: "Receta Eliminada",
                                text: "Se eliminó la receta",
                                icon: "success"
                            });

                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        }
    }
};
</script>
