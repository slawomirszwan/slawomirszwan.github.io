/*
 */
var ourModule = (function() {
    var _animals = ['dog', 'cat', 'bird'];

    var _addNewElement = function(newAnimal) {
        var elementToAdd;

        if (typeof newAnimal !== 'string') {
            elementToAdd = document.querySelector('#animal').value();
        } else {
            elementToAdd = newAnimal;
        }

        if (elementToAdd != '') {
            _animals.push(elementToAdd);
        }
    };

    var _displayList = function() {
        var list = document.querySelector('#list');
        if (list == null) {
            list = document.createElement('ul');
            list.id = list;
            document.querySelector('body').appendChild(list);
        }
        list.innerHTML = '';
        animals.forEach(function(el, i) {
            var element = document.createElement('li');
            element.innerHTML = el;
            list.appendChild(element);
        });
    };

    var _bindEvents = function() {
        document.querySelector('#number').addEventListener('click', _addNewElement.bind(this));
        document.querySelector('#show').addEventListener('click', _displayList.bind(this));
    };

    var _init = function() {
        bindEvents();
        displayList();
    };

    return {
        init : _init,
        addNewElement : _addNewElement,
        displayList : _displayList
    }
})();

//===================================================
var mymod = (function() {
  
  document.addEventListener("DOMContentLoaded", function() {
  
    console.log(window);
    console.log(document);


    var x=5;
    console.log(x);
    console.log(window.x);
    console.log(window['x']);

    console.log(document.forms);
    console.log(document.images);
    console.log(document.links);

  });
  
})();
