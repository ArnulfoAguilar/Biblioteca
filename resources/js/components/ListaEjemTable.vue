<template>
        <div>
            <JDTable
                :option="tableOptions"
                :loader="tableLoader"
                :event-from-app="eventFromApp"
                :event-from-app-trigger="eventFromAppTrigger"
                @event-from-jd-table="processEventFromApp($event)"/>
            <iframe id="excelExportArea" style="display:none"></iframe>
        </div>
</template>

<script>
export default {
    data(){
        return {
            tableOptions:{},
            tableLoader: false,
            eventFromAppTrigger: false,
            eventFromApp : {
                name: null,
                data: null
            },
            columns: [
                    {
                        name:'EJEMPLAR',
                        title:'Ejemplar',
                        order: 1,
                        sort: true,
                        type: 'string',
                        filterable: true,
                        enabled: true
                    },
                    {
                        name:'AUTOR',
                        title:'Autor',
                        order: 2,
                        sort: true,
                        type: 'string',
                        filterable: true,
                        enabled: true
                    },
                    {
                        name:'ISBN',
                        title:'ISBN',
                        order: 3,
                        sort: true,
                        type: 'string',
                        filterable: true,
                        enabled: true
                    }
                ]

        }
    },
    created(){
        this.tableOptions = {
            columns: this.columns,
            responsiveTable: true,
            addNew: true,
            deleteItem: true
        };
        this.sendData();
        console.log('componente creado')
    },
    mounted(){
        console.log('tabla montada')
    },
    methods:{
        sendData(){
            this.tableLoader = true;
            /*axios.get('/Biblioteca').then(res=>{
                this.eventFromApp = {
                    name: 'sendData',
                    payload: res.data
                };
                this.triggerEvent();
                this.tableLoader = false;
                //this.bibliotecas = res.data;
                });*/
            this.getData().then((result)=>
            {
                this.eventFromApp = {
                    name: 'sendData',
                    payload: result
                };
                this.triggerEvent();
                this.tableLoader = false;
            });

        },
        triggerEvent(){
            this.eventFromAppTrigger = true;
            this.$nextTick(()=>{
                this.eventFromAppTrigger = false;
            });
        },
        processEventFromApp(componentState){
            if(componentState.lastAction === 'Refresh'){
                this.getData.then((result)=>{
                    this.eventFromApp = {
                        name: 'sendData',
                        payload: result
                    };
                    this.triggerEvent();
                })
            }
            if (componentState.lastAction ==='AddItem') {
                window.location.href='/busqueda';
            }
        },
        getData(){
            return new Promise((resolve,reject)=>{
                let data =
                    [
                        // Row 1
                        {
                            EJEMPLAR : 'Burger King',
                            AUTOR  : 'James McLamore',
                            ISBN: '98439573945'
                        },
                        // Row 2
                        {
                            EJEMPLAR : 'Mc Donalds',
                            AUTOR  : 'Maurice McDonald',
                            ISBN: '353453453453'
                        }
                        // Row 3
                        ,
                        {
                            EJEMPLAR : 'Wendies',
                            AUTOR  : 'Dave Thomas',
                            ISBN: '132321547'
                        }
                        // etc.
                    ];
                resolve(data);
            });
        }
    }

}
</script>

<style>

</style>
