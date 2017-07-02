
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
                    :class="currentVote == -1 ? 'btn-primary' : 'btn-default'"
                    type="button"
                    class="btn">
                    -1
            </button>
        </form>
    </div>

</template>

<script>

    export default {
        props: ['score', 'vote'],
        data()
        {
            return {
                currentVote: this.vote ? parseInt(this.vote) : null,
                currentScore: parseInt(this.score),
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
                    this.currentScore += this.currentVote ? 2 : 1;
                    axios.post(`${ this.currentUrl }/upvote`);
                    this.currentVote = 1;
                }
            },
            downvote()
            {
                if (this.currentVote == -1)
                {
                    this.currentScore++;
                    axios.delete(`${ this.currentUrl }/vote`);
                    this.currentVote = null;
                }
                else
                {
                    this.currentScore += this.currentVote ? -2 : -1;
                    axios.post(`${ this.currentUrl }/downvote`);
                    this.currentVote = -1;
                }
            }
        }
    }

</script>
