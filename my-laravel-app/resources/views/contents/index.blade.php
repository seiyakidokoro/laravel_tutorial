<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sortablejs@1.7.0/Sortable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.24.0/vuedraggable.umd.js" integrity="sha512-EYjetZ6aWOnSVmopHk/lzLwfLt+Yp6RRb56BSNYev7DbEkt+Pmigif0VGGWoluDlkJxALFtvPhVVUF1Femmh3w==" crossorigin="anonymous"></script>
</head>
<body>
<div id="app" class="layout">
    <div class="side">
        <div class="input-wrapper">
            <input type="text" placeholder="addContents" @keydown.enter="addContents" v-model="input_add_contents">
        </div>
        <draggable :list="contents"
                   class="dragArea"
                   :move="beforeMove"
                   @end="onEnd">

            <div style="position: relative"  v-for="(content,index) in contents">
                <div :id="content.id" class="contentItem" @click="getContentDetails(content.id)" v-bind:class="[ activeContentItem === content.id ? 'active' : '' ]">
                    <div>{% content.title %}</div>
                    <span>文字数：1200</span>
                </div>
                <div @click="delete_content(index,content.id)" class="my-parts" style="position:absolute; top:-8px; right:-8px"><span></span></div>
            </div>
        </draggable>
    </div>
    <div class="main">
        <div class="input-wrapper">
            <input type="text" placeholder="addHeading" @keydown.enter="addContentDetails" v-model="input_add_content_details">
        </div>
        <div class="contentItem" v-for="content_detail in content_details" @click="getContentDetail(content_detail)">{% content_detail.name %}</div>
        <textarea v-model="text_content_detail" style="width:100%;height: 85vh"></textarea>
        <div>
            <button>音声入力</button>
            <button>音声再生</button>
            <button @click="saveDetail">保存</button>
            <button>コンパイル</button>
            <div>文字数：{% content_detail_count.length %}</div>
        </div>
    </div>
</div>

<script>
    new Vue({
        el: '#app',
        delimiters: ['{%', '%}'],
        data:{
            contents: [],
            input_add_contents: '',
            input_add_content_details: '',
            latest_contents_id: '',
            target_content_id: '',
            target_content_detail_id: '',
            target_content_detail_name: '',
            content_details:[],
            text_content_detail:'',
            content_detail_count:'',
            activeContentItem: 0
        },
        methods:{
            // コンテンツの保存
            addContents: function(e){
                if (e.keyCode !== 13) return

                axios.post('/api/add_contents', {
                    title: this.input_add_contents
                }).then(res => {
                    const result = res.data

                    const content = {};
                    content['id'] = result.id;
                    content['title'] = result.title;
                    this.contents.push(content)

                    this.latest_contents_id = this.latest_contents_id + 1

                    // リセット
                    this.input_add_contents = ''
                });
            },

            // 見出しの保存
            addContentDetails: function(e){
                if (e.keyCode !== 13) return

                axios.post('/api/add_content_details', {
                    content_id: this.target_content_id,
                    name: this.input_add_content_details
                }).then(res => {
                    const content = {};
                    content['id'] = res.data.id;
                    content['name'] = res.data.name;
                    content['content_id'] = res.data.content_id;
                    this.content_details.push(content)
                    this.input_add_content_details = ''

                    alert('保存が完了しました')
                });
            },
            // 本文の保存
            saveDetail: function(){
                axios.post('/api/save_content_detail', {
                    content_id: this.target_content_id,
                    content_detail_id: this.target_content_detail_id,
                    name: this.target_content_detail_name,
                    body: this.text_content_detail
                }).then(res => {
                    alert('保存が完了しました')
                });
            },

            // 見出し部分の取得
            getContentDetails: function(content_id){
                this.text_content_detail = ''
                this.target_content_id = content_id
                this.activeContentItem = content_id
                axios.post('/api/content_details',{
                    content_id:content_id
                }).then(res => {
                    this.content_details = res.data
                });
            },

            // テキストエリア部分の取得
            getContentDetail: function(content_detail){
                this.text_content_detail = ''
                this.text_content_detail = content_detail.body
                this.target_content_detail_id = content_detail.id
                this.target_content_detail_name = content_detail.name
            },

            // コンテンツ削除
            delete_content: function(index, id){
                axios.post('/api/delete_content',{
                    id:id
                }).then(res => {
                    this.contents.splice(index, 1);
                });
            },
            // draggable
            beforeMove:function(evt) {
                console.log(this.contents)
            },

            onEnd: function(evt) {
                console.log(this.contents)
            }
        },
        mounted:function(){
            axios.post('/api/content').then(res => {
                const contents = Object.keys(res.data).map(function (key) {return res.data[key]})
                this.contents = contents
                const content_ids = contents.map(function(id) {
                    return id
                });
                this.latest_contents_id = content_ids.slice(-1)[0]['id']
            });
        }
    })
</script>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    html{
        height: 100%;
    }
    body {
        height: 100%;
        background-color: #f5f5f5;
    }
    ul,li {
        list-style: none;
    }
    textarea {
        outline: none;
        padding: 6px 12px;
    }
    .layout{
        display: flex;
        padding: 4px 8px;
    }
    .side{
        width: 15%
    }
    .main{
        width: 70%;
        padding: 0 10%
    }
    .input-wrapper{
        margin-bottom: 20px;
    }
    .contentItem{
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 5px;
        padding: 2px 4px;
        box-shadow: 0 2px 5px #ccc;
    }
    .active{
        background-color: #ffc399;
    }
    .my-parts {
        display: inline-block;
        width: 18px;
        height: 18px;
        position: relative;
        cursor: pointer;
        color: #a9a9a9;
        /*border: 1px solid;*/
        /*border-radius: 50px;*/
    }
    .my-parts span::before,
    .my-parts span::after {
        display: block;
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 84%;
        height: 16%;
        margin: -8% 0 0 -42%;
        background: #a9a9a9;
    }
    .my-parts span::before {
        transform: rotate(-45deg);
    }
    .my-parts span::after {
        transform: rotate(45deg);
    }
</style>
</body>
</html>
