<!-- code by: Akash Rajendra => https://codepen.io/akashrajendra/pen/JKKRvQ-->
<style>
    *{
    transition: all 0.6s;
}

html {
    height: 100%;
}

body{
    font-family: 'Lato', sans-serif;
    color: #666;
    margin: 0;
}

#main{
    display: table;
    width: 100%;
    height: 100vh;
    text-align: center;
}

.fof{
	  display: table-cell;
	  vertical-align: middle;
}

.fof h1{
	  font-size: 50px;
	  display: inline-block;
	  padding-right: 12px;
	  animation: type .5s alternate infinite;
}

@keyframes type{
	  from{box-shadow: inset -3px 0px 0px #666;}
	  to{box-shadow: inset -3px 0px 0px transparent;}
}
</style>

<div id="main">
    	<div class="fof">
        		<h1>404 - Page Not Found</h1>
    	</div>
</div>