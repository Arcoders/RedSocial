
<template>

    <div>
        <form>
            <button @click.prevent="upvote"
                    :class="currentVote == 1 ? 'btn-primary' : 'btn-default'"
                    type="button"
                    class="btn">
                    +1
            </button>

            Puntuacón actual: <strong id="current-score">{{ currentScore }}</strong>

            <button @click.prevent="downvote"
            type="button" class="btn btn-default">-1</button>
        </form>
    </div>

</template>

<script>

    export default {
        props: ['score', 'vote'],
        data()
        {
            return {
                currentVote: this.vote,
                currentScore: this.score,
                currentUrl: window.location.href
            }
        },
        methods:
        {
            upvote()
            {
                if (this.currentVote == 1)
                {
                    this.currentScore--;
                    axios.delete(`${ this.currentUrl }/vote`);
                    this.currentVote = null;
                }
                else
                {
                    this.currentScore++;
                    axios.post(`${ this.currentUrl }/upvote`);
                    this.currentVote = 1;
                }
            },
            downvote()
            {

            }
        }
    }

</script>
