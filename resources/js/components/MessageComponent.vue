<template>
    
    <div v-if="output" class="app-message">{{ output }}</div>
    
</template>

<script>
export default {
    name: 'MessageComponent',
    props: {
        message: {
            type: String,
            required: true
        }
    },
    data () {
        return {
            laravelMessage: this.message,
            messageLength: this.message.length,
            i: 0,
            speed: 50,
            output: ''
        }
    },
    created() {
        this.typeWriter();
    },
    methods: {
        typeWriter() {
          if (this.i < this.messageLength) {
            this.output += this.laravelMessage.charAt(this.i);
            this.i++;
            setTimeout(this.typeWriter, this.speed);
          }
        }
    }
}
</script>
