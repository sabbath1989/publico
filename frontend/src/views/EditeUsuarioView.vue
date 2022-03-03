<template>
  
    <div class="relative w-4/12 bg-white shadow-md mx-auto my-10 p-5">
        <h3 class=" text-gray-700 font-semibold">Cadastro de usuários</h3>        
        <div class="mb-2">
            <input type="text" id="nome" v-model="nome" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400"  placeholder="Nome" />
        </div>
        <div class="mb-2">
            <input type="text" id="email" v-model="email" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400"  placeholder="E-mail" />
        </div>        
        <div class="mb-2">
            <input type="text" id="telefone" v-model="telefone" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400"  placeholder="Telefone" />
        </div>
        <div class="mb-2">
            <input type="file" id="image" name="image" accept="image/png, image/jpeg" ref="files" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400">
            <p class=" text-gray-600 font-bold text-sm">Deixe em branco o campo foto caso não deseje atualizar</p>
        </div>
        <div class="my-2">
            <p class=" text-green-600 font-bold text-center text-lg" id="mensagem">{{mensagem}}</p>
            <div>
                <p class=" text-red-600 font-bold text-center text-lg" v-for="(erro, i) in erros" :key="i">{{erro[0]}}</p>
            </div>            
        </div>
         <div class="my-6 flex">
            <button class="w-20 h-8 bg-black text-white shadow-md text-center pt" @click="atualizarUsuario">Salvar</button>
            <router-link to="/" class="w-20 h-8 bg-slate-500 text-white shadow-md text-center pt-1 ml-2">Voltar</router-link>
        </div>

    </div>

</template>

<script>

import axios from "axios";

export default {
    props: ['id'],   
    data(){
        return{
            dados: null,
            nome: null,
            email: null,
            telefone: null,
            mensagem: null,
            erros: null,
            image: null,
            loading: true,
            errored: false
        }
    },
    mounted () {
        this.loadDadosUsuarios();
    },
    methods: {
        async atualizarUsuario() {

            //console.log(this.$refs.files.files[0]);
            const headers = { 
                //'Content-Typer': 'application/json',
                'Accept': 'application/json',
                'Access-Control-Allow-Origin': '*',
                "Content-Typer": "multipart/form-data"
            };

            const form = new FormData();
            form.append("id", this.id);
            form.append("name", this.nome);
            form.append("email", this.email);
            form.append("phone", this.telefone);
            form.append("image", this.$refs.files.files[0]);

            axios
            .post('http://localhost/api/user/'+ this.id, form, headers)
            .then(response => {
                this.mensagem = response.data;
                this.erros = null;
                console.log(response.data);                
            
            })
            .catch(error => {
                console.log(error.response.data.errors);
                this.erros = error.response.data.errors;
                this.errored = true;
                this.mensagem = null;
            })
            .finally(() => this.loading = false)
        },
        loadDadosUsuarios(){
            axios
            .get('http://localhost/api/user/'+ this.id)
            .then(response => {
                this.dados = response.data
                this.nome                   = this.dados.name;
                this.email                  = this.dados.email;
                this.telefone               = this.dados.phone;
                //this.image                  = this.dados.image;
                console.log( response.data)
            })
            .catch(error => {
                console.log(error)
                this.errored = true
            })
            .finally(() => this.loading = false)
        }
    }
}
</script>

<style>

</style>