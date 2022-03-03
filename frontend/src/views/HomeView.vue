.<template>
    <div class="my-10">
        <div class="w-10/12 mx-auto mb-1 grid grid-flow-row-dense grid-cols-4">
            <h3 class="col-span-3 font-semibold align-middle h-8 block">Lista de Usuários</h3>
            <div>
                <router-link to="/novo" class="w-20 h-8 bg-black text-white shadow-md float-right text-center pt-1">Novo</router-link>
            </div>
        </div>
        <table class=" w-10/12 mx-auto border text-center bg-white shadow-md">
            <thead>
                <tr>
                    <th class="border h-10">Nome</th>
                    <th class="border h-10">E-mail</th>
                    <th class="border h-10">Telefone</th>
                    <th class="border h-10">#</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!dados">
                    <td class="border h-10" colspan="5">Nenhum usuário cadastrado</td>
                </tr>
                <tr v-for="dado in dados" :key="dado.id">
                    <td class="border h-10">{{dado.name}}</td>
                    <td class="border h-10">{{dado.email}}</td>
                    <td class="border h-10">{{dado.phone}}</td>                    
                    <td class="border h-10">
                        <a  :href="'/edit/' + dado.id" class=" inline-block w-5 h-8 bg-[url('./assets/edit.png')] bg-no-repeat bg-center bg-contain mr-2"></a>
                        <button class="w-5 h-8 bg-[url('./assets/delete.png')] bg-no-repeat bg-center bg-contain" @click="apagarUsuario(dado.id)"></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</template>

<script>
import axios from "axios";

export default {
    data () {
        return {
        dados: null,
        loading: true,
        errored: false,
        mensagem: null,
        erros: null
        }
    },
    mounted () {
        this.loadDadosUsuarios();
    },    
    methods: {
        async apagarUsuario(id) {
            
            if(confirm("Você realmente quer apagar o registro?")){
                //console.log(this.$refs.files.files[0]);
                const headers = { 
                    'Content-Typer': 'application/json',
                    'Accept': 'application/json',
                    'Access-Control-Allow-Origin': '*',
                };

                axios
                .delete('http://localhost/api/user/'+ id, headers)
                .then(response => {
                    this.mensagem = response.data;
                    this.erros = null;
                    this.loadDadosUsuarios();
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
        },
        loadDadosUsuarios(){
            axios
            .get('http://localhost/api/user')
            .then(response => {
                this.dados = response.data.data
                //console.log(response.data.data)
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