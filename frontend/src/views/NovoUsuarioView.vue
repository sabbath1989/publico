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
            <input type="password" id="password" v-model="password" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400"  placeholder="Senha" />
        </div>
        <div class="mb-2">
            <input type="password" id="password_confirmation" v-model="password_confirmation"  class=" w-full h-10 border-b border-grey-300 focus:outline-none p-2 text-gray-400"  placeholder="Confirme a Senha" />
        </div>
        <div class="mb-2">
            <input type="text" id="telefone" v-model="telefone" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400"  placeholder="Telefone" />
        </div>
        <div class="mb-2">
            <input type="file" id="image" name="image" accept="image/png, image/jpeg" ref="files" class=" w-full h-15 border-b border-grey-300 focus:outline-none p-2 text-gray-400">
        </div>
        <div class="my-2">
            <p class=" text-green-600 font-bold text-center text-lg" id="mensagem">{{mensagem}}</p>
            <div>
                <p class=" text-red-600 font-bold text-center text-lg" v-for="(erro, i) in erros" :key="i">{{erro[0]}}</p>
            </div>            
        </div>
         <div class="my-6 flex">
            <button class="w-20 h-8 bg-black text-white shadow-md text-center pt" @click="cadastraUser">Salvar</button>
            <router-link to="/" class="w-20 h-8 bg-slate-500 text-white shadow-md text-center pt-1 ml-2">Voltar</router-link>
        </div>

    </div>

</template>

<script>

import axios from "axios";

export default {
    name: "NovoUsario",
    data(){
        return{
            nome: null,
            email: null,
            password_confirmation: null,
            password: null,
            telefone: null,
            mensagem: null,
            erros: null,
            image: null,
            loading: true,
            errored: false
        }
    },
    methods: {
        async cadastraUser() {

            //console.log(this.$refs.files.files[0]);
            const headers = { 
                //'Content-Typer': 'application/json',
                'Accept': 'application/json',
                'Access-Control-Allow-Origin': '*',
                "Content-Typer": "multipart/form-data"
            };

            const form = new FormData();
            form.append("name", this.nome);
            form.append("email", this.email);
            form.append("password", this.password);
            form.append("password_confirmation", this.password_confirmation);
            form.append("phone", this.telefone);
            form.append("image", this.$refs.files.files[0]);

            axios
            .post('http://localhost/api/user', form, headers)
            .then(response => {
                this.mensagem = response.data
                this.erros = null;
                this.nome                   = null;
                this.email                  = null;
                this.password               = null;
                this.password_confirmation  = null;
                this.telefone               = null;
                this.image                  = null;

                console.log(response.data);                
            
            })
            .catch(error => {
                console.log(error.response.data.errors);
                this.erros = error.response.data.errors;
                this.errored = true;
                this.mensagem = null;
            })
            .finally(() => this.loading = false)


        }
    }
}
</script>

<style>

</style>