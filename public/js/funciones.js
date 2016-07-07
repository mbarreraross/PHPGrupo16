function deleteUser(id){
  $.ajax({
    method: "POST",
    url: "http://localhost/mvc/api/deleteUser?ajax=true",
    data: { id: id }
  })
  .done(function( result ) {
    if (result.success){
      $('a.delete#'+id).parent('td').parent('tr').remove();
    }
  });
}

function updateUser(id,bloqueado){
 $.ajax({
   method: "POST",
   url: "http://localhost/mvc/api/updateUser?ajax=true",
   data: { id: id , bloqueado: bloqueado}
 })
 .done(function( result ) {
   if (result.success){
       if(bloqueado==='on')
{
     $('a.bloquear#'+id).text('Desbloquear');}
 else{
     $('a.bloquear#'+id).text('Bloquear');
 }
   }
 });
}

function pairwise(list) {
  if (list.length == 1) { return list[0]; }
  var first = list[0],
      rest  = list.slice(1),
      pairs = rest.map(function (x) { return rest.concat(x); });

      console.log(pairs);
  return pairs.concat(pairwise(rest));
}

function cartesianProduct(arr)
{
    return arr.reduce(function(a,b){
        return a.map(function(x){
            return b.map(function(y){
                return x.concat(y);
            })
        }).reduce(function(a,b){ return a.concat(b) },[])
    }, [[]])
}

$(document).ready(function(){
  $('a.delete').click(function(){
    var id = $(this).attr('id');
	
    console.log('Click on item ', id);
    deleteUser(id);
  });
  
   $('a.bloquear').click(function(){
   var id = $(this).attr('id');
   
   var bloqueado;
   if ($(this).text()==='Bloquear')
   {
       bloqueado='on';
   }else{
       bloqueado='off';
   }

   console.log('Click on item ', id);
   updateUser(id,bloqueado);
 });
  
  console.log('cartesianProduct:', cartesianProduct([[1,2,3,4,5],[1,2,3,4,5]]));
});