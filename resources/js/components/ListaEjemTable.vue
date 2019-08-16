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
                        title:'Nombre ejemplar',
                        order: 1,
                        sort: true,
                        type: 'string',
                        filterable: true,
                        enabled: true
                    },
                    {
                        name:'AUTOR',
                        title:'Autor del ejemplar',
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
            responsiveTable: true
        };
        console.log('componente creado')
    },
    mounted(){
        this.sendData();
        console.log('tabla montada')
    },
    methods:{
        sendData(){
            this.tableLoader = true;
            this.getData().then((result)=>
            {
                this.eventFromApp = {
                    name: 'sendData',
                    payload: result
                };
                this.triggerEvent();
                this.tableLoader = true;
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
