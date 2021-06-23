<template>
    <div class="dropdown">
        <button class="btn dropdown-toggle mr-3 mybtn userlogindrop" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/req_sent.png" class="userAvatar"></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="area">

        </div>
    </div>
</template>

<script>
export default {
    name: "friends_requests",
    props:['id'],
    methods:
        {
          fetch_all_requests()
          {
              axios.get('/get_request'+this.id).then(resp=>{
                  let num=resp.data.length;
                  for(var i=0;i<num;i++)
                  {
                      let arr=resp.data[i];
                      let from=arr['from'];
                      let message=arr['message'];

                      document.getElementById('area').innerHTML+="<div class=\"dropdown-item\">\n" +
                          "                <p>"+message+"</p>" +
                          "                <button style=\"background-color: green; color: white;\" class=\"btn\" onclick=\"event.preventDefault();document.getElementById('accept').click();\">Accept</button>" +
                          "                <a href='accept"+from+"' id=\"accept\"></a>" +
                          "                <button style=\"background-color: red; color: white;\" class=\"btn\" onclick=\"event.preventDefault();document.getElementById('decline').click();\">decline</button>" +
                          "                <a href='decline"+from+"' id=\"decline\"></a>" +
                          "                <button  class=\"btn btn-light\" onclick=\"event.preventDefault();document.getElementById('view').click();\">view profile</button>" +
                          "                <a href='get-profile/"+from+"' id=\"view\"></a>" +
                          "            </div>";
                  }

              });
          }
        },
    mounted() {
        window.Echo.private("friend_req"+this.id)
            .listen('makerequest', (e) => {
                let from=e.from;
                let message=e.message;

                     document.getElementById('area').innerHTML+="<div class=\"dropdown-item\">\n" +
                         "                <p>"+message+"</p>" +
                         "                <button style=\"background-color: green; color: white;\" class=\"btn\" onclick=\"event.preventDefault();document.getElementById('accept').click();\">Accept</button>" +
                         "                <a href='accept"+from+"' id=\"accept\"></a>" +
                         "                <button style=\"background-color: red; color: white;\" class=\"btn\" onclick=\"event.preventDefault();document.getElementById('decline').click();\">decline</button>" +
                         "                <a href='decline"+from+"' id=\"decline\"></a>" +
                         "                <button  class=\"btn btn-light\" onclick=\"event.preventDefault();document.getElementById('view').click();\">view profile</button>" +
                         "                <a href='get-profile/"+from+"' id=\"view\"></a>" +
                         "            </div>";

            });
    },
    beforeMount(){
this.fetch_all_requests();
    },
}
</script>

<style scoped>

</style>
