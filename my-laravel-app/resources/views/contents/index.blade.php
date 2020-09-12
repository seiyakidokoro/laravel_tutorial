<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="robots" content="noindex" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('/js/vue.js') }}"></script>
    <script src="{{ asset('/js/axios.js') }}"></script>
    <script src="{{ asset('/js/sortable.js') }}"></script>
    <script src="{{ asset('/js/vue_draggable.js') }}"></script>
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

            <div class="contentWrapper" v-for="(content,index) in contents">
                <div :id="content.id" class="contentItem" v-bind:class="[ activeContentItem === content.id ? 'active' : '' ]" @click="getContentDetails(index,content.id)">
                    <div>{% content.title %}</div>
                    <span>文字数：1200</span>
                </div>
                <div @click="delete_content(index,content.id)" class="my-parts"><span></span></div>
            </div>
        </draggable>
    </div>
    <div class="main">
        <div class="input-wrapper">
            <input type="text" placeholder="addHeading" @keydown.enter="addContentDetails" v-model="input_add_content_details">
        </div>
        <div v-if="content_details.length">
            <div class="contentWrapper" v-for="(content_detail,index) in content_details">
                <div class="contentItem" v-bind:class="[ activeContentDetailItem === content_detail.id ? 'active2' : '' ]" @click="getContentDetail(content_detail)">
                    {% content_detail.name %}
                </div>
                <div @click="delete_content_detail(index,content_detail.id)" class="my-parts"><span></span></div>
            </div>
        </div>
        <div v-else>
            <div v-if="selected_content">「{% selected_content %}」にコンテンツを作成してください</div>
        </div>
        <textarea class="text_content_detail" v-composition-model="text_content_detail"></textarea>
        <div>
            <button>音声入力</button>
            <button @click="audioOutput">音声再生</button>
            <button @click="saveDetail">保存</button>
            <button>コンパイル</button>
            <a href="https://ap-northeast-1.console.aws.amazon.com/polly/home/SynthesizeSpeech" target="_blank">AmazonPolly</a>
            <div>文字数：{% content_detail_count %}</div>
        </div>
    </div>
</div>

<script>
    function vCompositionModelUpdate (el, { value, expression }, vnode) {
        vnode.context[expression] = el.value
    }

    Vue.directive('composition-model', {
        bind: function (el, binding, vnode) {
            el.value = binding.value
            el.addEventListener('keyup', () => vCompositionModelUpdate(el, binding, vnode))
            el.addEventListener('compositionend', () => vCompositionModelUpdate(el, binding, vnode))
        },
        // dataが直接書き換わったときの対応
        update: function (el, { value }) {
            el.value = value
        }
    })

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
            activeContentItem: 0,
            activeContentDetailItem: 0,
            selected_content: '',
        },
        computed:{
            content_detail_count: function(){
                return this.text_content_detail.length
            }
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

                    alert('保存が完了しました')
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
                    content['content_id'] = res.data.content_id;
                    content['name'] = res.data.name;
                    content['body'] = res.data.body;
                    this.content_details.push(content);
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
            getContentDetails: function(index,content_id){
                this.target_content_id = content_id
                this.activeContentItem = content_id
                axios.post('/api/content_details',{
                    content_id:content_id
                }).then(res => {
                    this.content_details = res.data
                    this.text_content_detail = ''
                    this.activeContentDetailItem = 0
                    this.selected_content = this.contents[index].title
                });
            },

            // テキストエリア部分の取得
            getContentDetail: function(content_detail){
                this.text_content_detail = ''
                this.text_content_detail = content_detail.body
                this.target_content_detail_id = content_detail.id
                this.target_content_detail_name = content_detail.name
                this.activeContentDetailItem = content_detail.id
            },

            // コンテンツ削除
            delete_content: function(index, id){
                axios.post('/api/delete_content',{
                    id:id
                }).then(res => {
                    this.contents.splice(index, 1);
                    alert('削除が完了しました')
                });
            },

            // コンテンツ詳細削除
            delete_content_detail: function(index, id){
                axios.post('/api/delete_content_detail',{
                    id:id
                }).then(res => {
                    this.content_details.splice(index, 1);
                    alert('削除が完了しました')
                });
            },

            // draggable
            beforeMove:function(evt) {
                console.log(this.contents)
            },

            onEnd: function(evt) {
                console.log(this.contents)
            },
            audioOutput: function(){
                // 音声出力
                let uttearnce = new SpeechSynthesisUtterance();
                uttearnce.text = this.text_content_detail;
                uttearnce.volume = 1;
                uttearnce.rate = 1;
                uttearnce.pitch = 1;
                uttearnce.lang = 'ja-JP'
                window.speechSynthesis.speak(uttearnce);
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
</body>
</html>
