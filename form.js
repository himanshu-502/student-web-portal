
function validateForm()
{
let co=document.myform.code.value;
let dt=document.myform.date.value;
let desc=document.myform.description.value;
let company=document.myform.company.value;
let pr=document.myform.price.value;
let logo=document.myform.logo.value;
if(company.value==-1 && logo.files.length==0)
{
    console.log("HELLO WORLD1");
    alert("Both fields cannot be empty!!!");
    return false;
}
console.log("HELLO WORLD");
if(company.value!=-1 && logo.files.length!=0)
{
    console.log("HELLO WORLD12");
    alert("you cannot enter both the fields");
    return false;
}
if(co.length<1)
{
    alert("coupon code cannot be empty!!!");
    return false;
}
if(!dt)
{
    alert("Please set the expiry date of the coupon!!!");
    return false;
}
if(!desc)
{
    alert("Please fill the description of the coupon!!!");
    return false;
}
if(pr<1)
{
    alert("Do you want to sell your coupon for free???");
    return false;
}
console.log("HELLO WORLD");

console.log("HELLO WORLD");
return true;
}
