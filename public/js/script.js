
function enable() {
    var check = document.getElementById("datadefend");
    if(check.checked){
        document.getElementById("regbtn").removeAttribute("disabled");
    } else {
        document.getElementById("regbtn").disabled = "true";
    }
}

function datadefend() {
    var check1 = document.getElementById("data");
    var check2 = document.getElementById("aszf");
    if(check1.checked){
        if(check2.checked) {
            document.getElementById("order").removeAttribute("disabled"); 
        } else {
            document.getElementById("order").disabled = "true";
        }
    } else {
        document.getElementById("order").disabled = "true";
    }
   
}

document.getElementById("kublikDecrement").onclick = function() {
    var kublik = document.getElementById("kublikPiece");
        var min = parseInt(kublik["min"]);
        var max = parseInt(kublik["max"]);
        var value = parseInt(kublik["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="kublikPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kublik[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("egyviragosKubli").innerHTML = newvalueHTML;
        }
}
document.getElementById("kublikIncrement").onclick = function() {
    var kublik = document.getElementById("kublikPiece");
    var min = parseInt(kublik["min"]);
    var max = parseInt(kublik["max"]);
    var value = parseInt(kublik["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="kublikPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kublik[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("egyviragosKubli").innerHTML = newvalueHTML;
        }
}
document.getElementById("kublik2Decrement").onclick = function() {
    var kublik2 = document.getElementById("kublik2Piece");
    var min = parseInt(kublik2["min"]);
    var max = parseInt(kublik2["max"]);
    var value = parseInt(kublik2["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="kublik2Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kublik2[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("haromviragosKubli").innerHTML = newvalueHTML;
        }
}
document.getElementById("kublik2Increment").onclick = function() {
    var kublik2 = document.getElementById("kublik2Piece");
    var min = parseInt(kublik2["min"]);
    var max = parseInt(kublik2["max"]);
    var value = parseInt(kublik2["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="kublik2Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kublik2[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("haromviragosKubli").innerHTML = newvalueHTML;
        }
}
document.getElementById("rattanDecrement").onclick = function() {
    var rattan = document.getElementById("rattanPiece");
    var min = parseInt(rattan["min"]);
    var max = parseInt(rattan["max"]);
    var value = parseInt(rattan["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="rattanPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $rattan[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("rattan1").innerHTML = newvalueHTML;
        }
}
document.getElementById("rattanIncrement").onclick = function() {
    var rattan = document.getElementById("rattanPiece");
    var min = parseInt(rattan["min"]);
    var max = parseInt(rattan["max"]);
    var value = parseInt(rattan["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="rattanPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $rattan[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("rattan1").innerHTML = newvalueHTML;
        }
}
document.getElementById("rattan2Decrement").onclick = function() {
    var rattan2 = document.getElementById("rattan2Piece");
    var min = parseInt(rattan2["min"]);
    var max = parseInt(rattan2["max"]);
    var value = parseInt(rattan2["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="rattan2Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $rattan2[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("rattan2").innerHTML = newvalueHTML;
        }
}
document.getElementById("rattan2Increment").onclick = function() {
    var rattan2 = document.getElementById("rattan2Piece");
    var min = parseInt(rattan2["min"]);
    var max = parseInt(rattan2["max"]);
    var value = parseInt(rattan2["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="rattan2Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $rattan2[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("rattan2").innerHTML = newvalueHTML;
        }
}
document.getElementById("heartboxDecrement").onclick = function() {
    var heartbox = document.getElementById("heartboxPiece");
    var min = parseInt(heartbox["min"]);
    var max = parseInt(heartbox["max"]);
    var value = parseInt(heartbox["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="heartboxPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $heartbox[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("heartbox1").innerHTML = newvalueHTML;
        }
}
document.getElementById("heartboxIncrement").onclick = function() {
    var heartbox = document.getElementById("heartboxPiece");
    var min = parseInt(heartbox["min"]);
    var max = parseInt(heartbox["max"]);
    var value = parseInt(heartbox["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="heartboxPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $heartbox[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("heartbox1").innerHTML = newvalueHTML;
        }
}
document.getElementById("koszoruDecrement").onclick = function() {
    var koszoru = document.getElementById("koszoruPiece");
    var min = parseInt(koszoru["min"]);
    var max = parseInt(koszoru["max"]);
    var value = parseInt(koszoru["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="koszoruPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $koszoru[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("koszoru1").innerHTML = newvalueHTML;
        }
}
document.getElementById("koszoruIncrement").onclick = function() {
    var koszoru = document.getElementById("koszoruPiece");
    var min = parseInt(koszoru["min"]);
    var max = parseInt(koszoru["max"]);
    var value = parseInt(koszoru["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="koszoruPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $koszoru[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("koszoru1").innerHTML = newvalueHTML;
        }
}
document.getElementById("szalasDecrement").onclick = function() {
    var szalas = document.getElementById("szalasPiece");
    var min = parseInt(szalas["min"]);
    var max = parseInt(szalas["max"]);
    var value = parseInt(szalas["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="szalasPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $szalas[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("szalas1").innerHTML = newvalueHTML;
        }
}
document.getElementById("szalasIncrement").onclick = function() {
    var szalas = document.getElementById("szalasPiece");
    var min = parseInt(szalas["min"]);
    var max = parseInt(szalas["max"]);
    var value = parseInt(szalas["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="szalasPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $szalas[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("szalas1").innerHTML = newvalueHTML;
        }
}
document.getElementById("kaspo1Decrement").onclick = function() {
    var kaspo1 = document.getElementById("kaspo1Piece");
    var min = parseInt(kaspo1["min"]);
    var max = parseInt(kaspo1["max"]);
    var value = parseInt(kaspo1["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="kaspo1Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kaspo1[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("kaspo-1").innerHTML = newvalueHTML;
        }
}
document.getElementById("kaspo1Increment").onclick = function() {
    var kaspo1 = document.getElementById("kaspo1Piece");
    var min = parseInt(kaspo1["min"]);
    var max = parseInt(kaspo1["max"]);
    var value = parseInt(kaspo1["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="kaspo1Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kaspo1[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("kaspo-1").innerHTML = newvalueHTML;
        }
}
document.getElementById("kaspo2Decrement").onclick = function() {
    var kaspo2 = document.getElementById("kaspo2Piece");
    var min = parseInt(kaspo2["min"]);
    var max = parseInt(kaspo2["max"]);
    var value = parseInt(kaspo2["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="kaspo2Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kaspo2[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("kaspo-2").innerHTML = newvalueHTML;
        }
}
document.getElementById("kaspo2Increment").onclick = function() {
    var kaspo2 = document.getElementById("kaspo2Piece");
    var min = parseInt(kaspo2["min"]);
    var max = parseInt(kaspo2["max"]);
    var value = parseInt(kaspo2["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="kaspo2Piece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $kaspo2[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("kaspo-2").innerHTML = newvalueHTML;
        }
}
document.getElementById("angelDecrement").onclick = function() {
    var angel = document.getElementById("angelPiece");
    var min = parseInt(angel["min"]);
    var max = parseInt(angel["max"]);
    var value = parseInt(angel["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="angelPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $angel[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("angel1").innerHTML = newvalueHTML;
        }
}
document.getElementById("angelIncrement").onclick = function() {
    var angel = document.getElementById("angelPiece");
    var min = parseInt(angel["min"]);
    var max = parseInt(angel["max"]);
    var value = parseInt(angel["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="angelPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $angel[$index]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("angel1").innerHTML = newvalueHTML;
        }
}
document.getElementById("mikulasDecrement").onclick = function() {
    var mikulas = document.getElementById("mikulasPiece");
    var min = parseInt(mikulas["min"]);
    var max = parseInt(mikulas["max"]);
    var value = parseInt(mikulas["value"]);
        if(value !== min) {
            var newvalue = value - 1;
            var newvalueHTML =  
            `<input id="mikulasPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $mikulas[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("mikulas1").innerHTML = newvalueHTML;
        }
}
document.getElementById("mikulasIncrement").onclick = function() {
    var mikulas = document.getElementById("mikulasPiece");
    var min = parseInt(mikulas["min"]);
    var max = parseInt(mikulas["max"]);
    var value = parseInt(mikulas["value"]);
        if(value !== max) {
            var newvalue = value + 1;
            var newvalueHTML =  
            `<input id="mikulasPiece" class="input-number" name="piece" value="${newvalue}" type="text" min="${min}" max="${max}" <?php echo $mikulas[$index2]['piece'] === 0 ? "disabled" : "" ?></div>`;
            document.getElementById("mikulas1").innerHTML = newvalueHTML;
        }
}
