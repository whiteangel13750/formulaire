<?php

// il désigne les opérations permettant la gestion d'une collection d'éléments.

interface Crud {
    function insert();
    function selectAll();
    function select();
    function update();
    function delete();
}