<template>
    <div class="demo-test-area--wrapper" :style="{color: textColor}">
        <form class="demo-test-area" @submit.prevent="_handleSubmit" @keyup="_handleTyping">
         <div class="demo-test-area--preamble">
            <p>Test the chat window by sending a message:</p>
            <p v-if="userIsTyping">User is typing...</p>
        </div>
        <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
            <div>
                <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                </svg>
                </button>
            </div>
            <div class="flex-grow ml-4">
                <div class="relative w-full">
                <input type="text" ref="textArea"  class="demo-test-area--text flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10">
                <button class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </button>
                </div>
            </div>
            <div class="ml-4">
                <button class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0 demo-test-area--button">
                <span>Send</span>
                <span class="ml-2">
                    <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </span>
                </button>
            </div>
        </div>

        <!-- <textarea ref="textArea" class="demo-test-area--text" placeholder="Write a test message...." :style="textareaStyle" /> -->
        <!-- <button class="demo-test-area--button" :style="{background: ctaColor, color: colors.sentMessage.text}"> Send Message! </button> -->
        </form>
    </div>
</template>
<script>
export default {
  props: {
    onMessage: {
      type: Function,
      required: true
    },
    onTyping: {
      type: Function,
      required: true
    },
    colors: {
      type: Object,
      required: true
    },
    chosenColor: {
      type: String,
      required: true
    },
    messageStyling: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      userIsTyping: false
    }
  },
  methods: {
    _handleSubmit() {
      this.onMessage(this.$refs.textArea.value)
      this.$refs.textArea.value = ''
      this.onTyping('')
    },
    _handleTyping() {
      this.onTyping(this.$refs.textArea.value)
    }
  },
  computed: {
    linkColor() {
      return this.chosenColor === 'dark' ? this.colors.sentMessage.text : this.colors.launcher.bg
    },
    backgroundColor() {
      return this.chosenColor === 'dark' ? this.colors.messageList.bg : '#fff'
    },
    textColor() {
      return this.chosenColor === 'dark' ? '#eee' : '#222'
    },
    ctaColor() {
      return this.chosenColor === 'dark' ? this.colors.userInput.bg : this.colors.launcher.bg
    },
    textareaStyle() {
      return {
        background: this.chosenColor === 'dark' ? this.colors.messageList.bg : '#fff',
        color: this.chosenColor === 'dark' ? this.colors.sentMessage.text : '#222'
      }
    }
  },
  mounted() {
    this.$root.$on('onType', () => {
      this.userIsTyping = true
      setTimeout(() => {
        this.userIsTyping = false
      }, 3000);
    })
  }
}
</script>
<style scoped>
.demo-test-area--wrapper {
  width: 100%;
  display: flex;
  flex-direction: column;
}

.demo-test-area--title {
  align-self: center;
  text-align: center;
}

.demo-test-area--title-main {
  font-weight: 600;
  font-size: 28px;
}

.demo-test-area--title-sub {
  padding-top: 10px;
  font-size: small;
}

.demo-test-area {
  align-self: center;
  margin-top: 30px;
  width: 400px;
  display: flex;
  flex-direction: column;
}

.demo-test-area--preamble {
  padding: 20px 0px;
  text-align: center;
}

.demo-test-area--button {
  font-family: Avenir Next, Helvetica Neue, Helvetica, sans-serif;
  font-weight: 400;
  margin-top: 20px;
  user-select: none;
  border: none;
  line-height: 1.4;
  text-decoration: none;
  background: #4e8cff;
  color: white;
  padding: 6px 10px;
  font-size: 20px;
  height: 50px;
  border-radius: 4px;
  width: 80%;
  box-sizing: border-box;
  outline: none;
  cursor: pointer;
  align-self: center;
}

.demo-test-area--button:hover {
  background: #4883f1;
}

.demo-test-area--info {
  margin: auto;
  margin-top: 40px;
  font-weight: 200;
  width: 550px;
}

.demo-test-area--info a {
  font-weight: 400;
  text-decoration: none;
  color: #4e8cff;
}
</style>
