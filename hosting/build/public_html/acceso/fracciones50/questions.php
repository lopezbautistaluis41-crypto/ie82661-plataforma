<?php
declare(strict_types=1);
return json_decode(<<<'BANK'
[
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 1/4 y luego 2/4 de la cinta. ¿Qué fracción se utiliza en total?",
    "operation": [
      1,
      4,
      "+",
      2,
      4
    ],
    "text": "Para una actividad se utilizan 1/4 y luego 2/4 de la cinta. ¿Qué fracción se utiliza en total? · 1/4 + 2/4",
    "answer": [
      3,
      4
    ],
    "wrong": [
      [
        3,
        8
      ],
      [
        1,
        8
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 4 y opera los numeradores: 1 + 2 = 3. El resultado es 3/4, equivalente a 3/4.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 4 partes coloreadas y 2 de 4 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-01.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 2/5 y luego 1/5 de la cartulina. ¿Qué fracción se utiliza en total?",
    "operation": [
      2,
      5,
      "+",
      1,
      5
    ],
    "text": "Para una actividad se utilizan 2/5 y luego 1/5 de la cartulina. ¿Qué fracción se utiliza en total? · 2/5 + 1/5",
    "answer": [
      3,
      5
    ],
    "wrong": [
      [
        3,
        10
      ],
      [
        1,
        10
      ],
      [
        4,
        5
      ]
    ],
    "explanation": "Conserva el denominador 5 y opera los numeradores: 2 + 1 = 3. El resultado es 3/5, equivalente a 3/5.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 5 partes coloreadas y 1 de 5 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-02.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Un equipo avanza 3/8 de un recorrido por la mañana y 2/8 por la tarde. ¿Qué fracción del recorrido avanza en total?",
    "operation": [
      3,
      8,
      "+",
      2,
      8
    ],
    "text": "Un equipo avanza 3/8 de un recorrido por la mañana y 2/8 por la tarde. ¿Qué fracción del recorrido avanza en total? · 3/8 + 2/8",
    "answer": [
      5,
      8
    ],
    "wrong": [
      [
        5,
        16
      ],
      [
        1,
        16
      ],
      [
        3,
        4
      ]
    ],
    "explanation": "Conserva el denominador 8 y opera los numeradores: 3 + 2 = 5. El resultado es 5/8, equivalente a 5/8.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 8 partes coloreadas y 2 de 8 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-03.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 1/6 y luego 4/6 de la jarra. ¿Qué fracción se utiliza en total?",
    "operation": [
      1,
      6,
      "+",
      4,
      6
    ],
    "text": "Para una actividad se utilizan 1/6 y luego 4/6 de la jarra. ¿Qué fracción se utiliza en total? · 1/6 + 4/6",
    "answer": [
      5,
      6
    ],
    "wrong": [
      [
        5,
        12
      ],
      [
        1,
        4
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 6 y opera los numeradores: 1 + 4 = 5. El resultado es 5/6, equivalente a 5/6.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 6 partes coloreadas y 4 de 6 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-04.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 2/7 y luego 3/7 de la parcela. ¿Qué fracción se utiliza en total?",
    "operation": [
      2,
      7,
      "+",
      3,
      7
    ],
    "text": "Para una actividad se utilizan 2/7 y luego 3/7 de la parcela. ¿Qué fracción se utiliza en total? · 2/7 + 3/7",
    "answer": [
      5,
      7
    ],
    "wrong": [
      [
        5,
        14
      ],
      [
        1,
        14
      ],
      [
        6,
        7
      ]
    ],
    "explanation": "Conserva el denominador 7 y opera los numeradores: 2 + 3 = 5. El resultado es 5/7, equivalente a 5/7.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 7 partes coloreadas y 3 de 7 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-05.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 3/10 y luego 5/10 del listón. ¿Qué fracción se utiliza en total?",
    "operation": [
      3,
      10,
      "+",
      5,
      10
    ],
    "text": "Para una actividad se utilizan 3/10 y luego 5/10 del listón. ¿Qué fracción se utiliza en total? · 3/10 + 5/10",
    "answer": [
      4,
      5
    ],
    "wrong": [
      [
        2,
        5
      ],
      [
        1,
        10
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 10 y opera los numeradores: 3 + 5 = 8. El resultado es 8/10, equivalente a 4/5.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 10 partes coloreadas y 5 de 10 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-06.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Lucía lee 1/9 de un libro el lunes y 6/9 el martes. ¿Qué fracción del libro ha leído?",
    "operation": [
      1,
      9,
      "+",
      6,
      9
    ],
    "text": "Lucía lee 1/9 de un libro el lunes y 6/9 el martes. ¿Qué fracción del libro ha leído? · 1/9 + 6/9",
    "answer": [
      7,
      9
    ],
    "wrong": [
      [
        7,
        18
      ],
      [
        5,
        18
      ],
      [
        8,
        9
      ]
    ],
    "explanation": "Conserva el denominador 9 y opera los numeradores: 1 + 6 = 7. El resultado es 7/9, equivalente a 7/9.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 9 partes coloreadas y 6 de 9 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-07.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 4/12 y luego 5/12 de la tela. ¿Qué fracción se utiliza en total?",
    "operation": [
      4,
      12,
      "+",
      5,
      12
    ],
    "text": "Para una actividad se utilizan 4/12 y luego 5/12 de la tela. ¿Qué fracción se utiliza en total? · 4/12 + 5/12",
    "answer": [
      3,
      4
    ],
    "wrong": [
      [
        3,
        8
      ],
      [
        1,
        24
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 12 y opera los numeradores: 4 + 5 = 9. El resultado es 9/12, equivalente a 3/4.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 4 de 12 partes coloreadas y 5 de 12 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-08.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 2/3 y luego 1/3 de la barra. ¿Qué fracción se utiliza en total?",
    "operation": [
      2,
      3,
      "+",
      1,
      3
    ],
    "text": "Para una actividad se utilizan 2/3 y luego 1/3 de la barra. ¿Qué fracción se utiliza en total? · 2/3 + 1/3",
    "answer": [
      1,
      1
    ],
    "wrong": [
      [
        1,
        2
      ],
      [
        1,
        6
      ],
      [
        2,
        1
      ]
    ],
    "explanation": "Conserva el denominador 3 y opera los numeradores: 2 + 1 = 3. El resultado es 3/3, equivalente a 1/1.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 3 partes coloreadas y 1 de 3 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-09.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para una actividad se utilizan 5/8 y luego 1/8 de la pista. ¿Qué fracción se utiliza en total?",
    "operation": [
      5,
      8,
      "+",
      1,
      8
    ],
    "text": "Para una actividad se utilizan 5/8 y luego 1/8 de la pista. ¿Qué fracción se utiliza en total? · 5/8 + 1/8",
    "answer": [
      3,
      4
    ],
    "wrong": [
      [
        3,
        8
      ],
      [
        1,
        4
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 8 y opera los numeradores: 5 + 1 = 6. El resultado es 6/8, equivalente a 3/4.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 5 de 8 partes coloreadas y 1 de 8 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-10.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 3/5 de la cinta. Se utilizan 1/5. ¿Qué fracción queda?",
    "operation": [
      3,
      5,
      "-",
      1,
      5
    ],
    "text": "Para un proyecto hay 3/5 de la cinta. Se utilizan 1/5. ¿Qué fracción queda? · 3/5 − 1/5",
    "answer": [
      2,
      5
    ],
    "wrong": [
      [
        1,
        5
      ],
      [
        3,
        5
      ],
      [
        4,
        5
      ]
    ],
    "explanation": "Conserva el denominador 5 y opera los numeradores: 3 − 1 = 2. El resultado es 2/5, equivalente a 2/5.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 5 partes coloreadas y 1 de 5 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-11.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 7/8 de la cartulina. Se utilizan 2/8. ¿Qué fracción queda?",
    "operation": [
      7,
      8,
      "-",
      2,
      8
    ],
    "text": "Para un proyecto hay 7/8 de la cartulina. Se utilizan 2/8. ¿Qué fracción queda? · 7/8 − 2/8",
    "answer": [
      5,
      8
    ],
    "wrong": [
      [
        9,
        16
      ],
      [
        5,
        16
      ],
      [
        3,
        4
      ]
    ],
    "explanation": "Conserva el denominador 8 y opera los numeradores: 7 − 2 = 5. El resultado es 5/8, equivalente a 5/8.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 7 de 8 partes coloreadas y 2 de 8 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-12.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 5/6 del recorrido. Se utilizan 2/6. ¿Qué fracción queda?",
    "operation": [
      5,
      6,
      "-",
      2,
      6
    ],
    "text": "Para un proyecto hay 5/6 del recorrido. Se utilizan 2/6. ¿Qué fracción queda? · 5/6 − 2/6",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        7,
        12
      ],
      [
        1,
        4
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 6 y opera los numeradores: 5 − 2 = 3. El resultado es 3/6, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 5 de 6 partes coloreadas y 2 de 6 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-13.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 6/7 de la jarra. Se utilizan 3/7. ¿Qué fracción queda?",
    "operation": [
      6,
      7,
      "-",
      3,
      7
    ],
    "text": "Para un proyecto hay 6/7 de la jarra. Se utilizan 3/7. ¿Qué fracción queda? · 6/7 − 3/7",
    "answer": [
      3,
      7
    ],
    "wrong": [
      [
        9,
        14
      ],
      [
        3,
        14
      ],
      [
        4,
        7
      ]
    ],
    "explanation": "Conserva el denominador 7 y opera los numeradores: 6 − 3 = 3. El resultado es 3/7, equivalente a 3/7.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 6 de 7 partes coloreadas y 3 de 7 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-14.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 9/10 de la parcela. Se utilizan 4/10. ¿Qué fracción queda?",
    "operation": [
      9,
      10,
      "-",
      4,
      10
    ],
    "text": "Para un proyecto hay 9/10 de la parcela. Se utilizan 4/10. ¿Qué fracción queda? · 9/10 − 4/10",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        13,
        20
      ],
      [
        1,
        4
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Conserva el denominador 10 y opera los numeradores: 9 − 4 = 5. El resultado es 5/10, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 9 de 10 partes coloreadas y 4 de 10 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-15.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 8/9 del listón. Se utilizan 5/9. ¿Qué fracción queda?",
    "operation": [
      8,
      9,
      "-",
      5,
      9
    ],
    "text": "Para un proyecto hay 8/9 del listón. Se utilizan 5/9. ¿Qué fracción queda? · 8/9 − 5/9",
    "answer": [
      1,
      3
    ],
    "wrong": [
      [
        13,
        18
      ],
      [
        1,
        6
      ],
      [
        2,
        3
      ]
    ],
    "explanation": "Conserva el denominador 9 y opera los numeradores: 8 − 5 = 3. El resultado es 3/9, equivalente a 1/3.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 8 de 9 partes coloreadas y 5 de 9 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-16.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 11/12 del libro. Se utilizan 7/12. ¿Qué fracción queda?",
    "operation": [
      11,
      12,
      "-",
      7,
      12
    ],
    "text": "Para un proyecto hay 11/12 del libro. Se utilizan 7/12. ¿Qué fracción queda? · 11/12 − 7/12",
    "answer": [
      1,
      3
    ],
    "wrong": [
      [
        3,
        4
      ],
      [
        1,
        6
      ],
      [
        2,
        3
      ]
    ],
    "explanation": "Conserva el denominador 12 y opera los numeradores: 11 − 7 = 4. El resultado es 4/12, equivalente a 1/3.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 11 de 12 partes coloreadas y 7 de 12 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-17.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 4/5 de la tela. Se utilizan 2/5. ¿Qué fracción queda?",
    "operation": [
      4,
      5,
      "-",
      2,
      5
    ],
    "text": "Para un proyecto hay 4/5 de la tela. Se utilizan 2/5. ¿Qué fracción queda? · 4/5 − 2/5",
    "answer": [
      2,
      5
    ],
    "wrong": [
      [
        3,
        5
      ],
      [
        1,
        5
      ],
      [
        4,
        5
      ]
    ],
    "explanation": "Conserva el denominador 5 y opera los numeradores: 4 − 2 = 2. El resultado es 2/5, equivalente a 2/5.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 4 de 5 partes coloreadas y 2 de 5 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-18.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 5/7 de la barra. Se utilizan 1/7. ¿Qué fracción queda?",
    "operation": [
      5,
      7,
      "-",
      1,
      7
    ],
    "text": "Para un proyecto hay 5/7 de la barra. Se utilizan 1/7. ¿Qué fracción queda? · 5/7 − 1/7",
    "answer": [
      4,
      7
    ],
    "wrong": [
      [
        3,
        7
      ],
      [
        2,
        7
      ],
      [
        5,
        7
      ]
    ],
    "explanation": "Conserva el denominador 7 y opera los numeradores: 5 − 1 = 4. El resultado es 4/7, equivalente a 4/7.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 5 de 7 partes coloreadas y 1 de 7 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-19.svg"
  },
  {
    "category": "Homogéneas",
    "prompt": "Para un proyecto hay 7/10 de la pista. Se utilizan 3/10. ¿Qué fracción queda?",
    "operation": [
      7,
      10,
      "-",
      3,
      10
    ],
    "text": "Para un proyecto hay 7/10 de la pista. Se utilizan 3/10. ¿Qué fracción queda? · 7/10 − 3/10",
    "answer": [
      2,
      5
    ],
    "wrong": [
      [
        1,
        2
      ],
      [
        1,
        5
      ],
      [
        3,
        5
      ]
    ],
    "explanation": "Conserva el denominador 10 y opera los numeradores: 7 − 3 = 4. El resultado es 4/10, equivalente a 2/5.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 7 de 10 partes coloreadas y 3 de 10 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-20.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para una actividad se utilizan 1/2 y luego 1/4 de la cinta. ¿Qué fracción se utiliza en total?",
    "operation": [
      1,
      2,
      "+",
      1,
      4
    ],
    "text": "Para una actividad se utilizan 1/2 y luego 1/4 de la cinta. ¿Qué fracción se utiliza en total? · 1/2 + 1/4",
    "answer": [
      3,
      4
    ],
    "wrong": [
      [
        1,
        3
      ],
      [
        0,
        1
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 4: 1/2 = 2/4 y 1/4 = 1/4. El resultado es 3/4, equivalente a 3/4.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 2 partes coloreadas y 1 de 4 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-21.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para una actividad se utilizan 1/3 y luego 1/6 de la cartulina. ¿Qué fracción se utiliza en total?",
    "operation": [
      1,
      3,
      "+",
      1,
      6
    ],
    "text": "Para una actividad se utilizan 1/3 y luego 1/6 de la cartulina. ¿Qué fracción se utiliza en total? · 1/3 + 1/6",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        2,
        9
      ],
      [
        0,
        1
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 6: 1/3 = 2/6 y 1/6 = 1/6. El resultado es 3/6, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 3 partes coloreadas y 1 de 6 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-22.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Un equipo avanza 2/3 de un recorrido por la mañana y 1/9 por la tarde. ¿Qué fracción del recorrido avanza en total?",
    "operation": [
      2,
      3,
      "+",
      1,
      9
    ],
    "text": "Un equipo avanza 2/3 de un recorrido por la mañana y 1/9 por la tarde. ¿Qué fracción del recorrido avanza en total? · 2/3 + 1/9",
    "answer": [
      7,
      9
    ],
    "wrong": [
      [
        1,
        4
      ],
      [
        1,
        12
      ],
      [
        8,
        9
      ]
    ],
    "explanation": "Usa el denominador común 9: 2/3 = 6/9 y 1/9 = 1/9. El resultado es 7/9, equivalente a 7/9.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 3 partes coloreadas y 1 de 9 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-23.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para una actividad se utilizan 1/4 y luego 2/8 de la jarra. ¿Qué fracción se utiliza en total?",
    "operation": [
      1,
      4,
      "+",
      2,
      8
    ],
    "text": "Para una actividad se utilizan 1/4 y luego 2/8 de la jarra. ¿Qué fracción se utiliza en total? · 1/4 + 2/8",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        1,
        4
      ],
      [
        1,
        12
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 8: 1/4 = 2/8 y 2/8 = 2/8. El resultado es 4/8, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 4 partes coloreadas y 2 de 8 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-24.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para una actividad se utilizan 2/5 y luego 1/10 de la parcela. ¿Qué fracción se utiliza en total?",
    "operation": [
      2,
      5,
      "+",
      1,
      10
    ],
    "text": "Para una actividad se utilizan 2/5 y luego 1/10 de la parcela. ¿Qué fracción se utiliza en total? · 2/5 + 1/10",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        1,
        5
      ],
      [
        1,
        15
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 10: 2/5 = 4/10 y 1/10 = 1/10. El resultado es 5/10, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 5 partes coloreadas y 1 de 10 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-25.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para una actividad se utilizan 3/4 y luego 1/8 del listón. ¿Qué fracción se utiliza en total?",
    "operation": [
      3,
      4,
      "+",
      1,
      8
    ],
    "text": "Para una actividad se utilizan 3/4 y luego 1/8 del listón. ¿Qué fracción se utiliza en total? · 3/4 + 1/8",
    "answer": [
      7,
      8
    ],
    "wrong": [
      [
        1,
        3
      ],
      [
        1,
        6
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 8: 3/4 = 6/8 y 1/8 = 1/8. El resultado es 7/8, equivalente a 7/8.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 4 partes coloreadas y 1 de 8 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-26.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Lucía lee 1/2 de un libro el lunes y 2/6 el martes. ¿Qué fracción del libro ha leído?",
    "operation": [
      1,
      2,
      "+",
      2,
      6
    ],
    "text": "Lucía lee 1/2 de un libro el lunes y 2/6 el martes. ¿Qué fracción del libro ha leído? · 1/2 + 2/6",
    "answer": [
      5,
      6
    ],
    "wrong": [
      [
        3,
        8
      ],
      [
        1,
        8
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 6: 1/2 = 3/6 y 2/6 = 2/6. El resultado es 5/6, equivalente a 5/6.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 2 partes coloreadas y 2 de 6 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-27.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para una actividad se utilizan 2/3 y luego 1/6 de la tela. ¿Qué fracción se utiliza en total?",
    "operation": [
      2,
      3,
      "+",
      1,
      6
    ],
    "text": "Para una actividad se utilizan 2/3 y luego 1/6 de la tela. ¿Qué fracción se utiliza en total? · 2/3 + 1/6",
    "answer": [
      5,
      6
    ],
    "wrong": [
      [
        1,
        3
      ],
      [
        1,
        9
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 6: 2/3 = 4/6 y 1/6 = 1/6. El resultado es 5/6, equivalente a 5/6.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 3 partes coloreadas y 1 de 6 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-28.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "En el taller se usan 3/5 de una cinta y 1/2 de otra cinta del mismo tamaño. ¿Cuántas cintas se usan en total?",
    "operation": [
      3,
      5,
      "+",
      1,
      2
    ],
    "text": "En el taller se usan 3/5 de una cinta y 1/2 de otra cinta del mismo tamaño. ¿Cuántas cintas se usan en total? · 3/5 + 1/2",
    "answer": [
      11,
      10
    ],
    "wrong": [
      [
        4,
        7
      ],
      [
        2,
        7
      ],
      [
        6,
        5
      ]
    ],
    "explanation": "Usa el denominador común 10: 3/5 = 6/10 y 1/2 = 5/10. El resultado es 11/10, equivalente a 11/10.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 5 partes coloreadas y 1 de 2 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-29.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "En el taller se usan 1/3 de una cinta y 3/4 de otra cinta del mismo tamaño. ¿Cuántas cintas se usan en total?",
    "operation": [
      1,
      3,
      "+",
      3,
      4
    ],
    "text": "En el taller se usan 1/3 de una cinta y 3/4 de otra cinta del mismo tamaño. ¿Cuántas cintas se usan en total? · 1/3 + 3/4",
    "answer": [
      13,
      12
    ],
    "wrong": [
      [
        4,
        7
      ],
      [
        2,
        7
      ],
      [
        7,
        6
      ]
    ],
    "explanation": "Usa el denominador común 12: 1/3 = 4/12 y 3/4 = 9/12. El resultado es 13/12, equivalente a 13/12.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 1 de 3 partes coloreadas y 3 de 4 partes coloreadas. Operación: suma.",
    "image": "imagenes/ejercicio-30.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 3/4 de la cinta. Se utilizan 1/2. ¿Qué fracción queda?",
    "operation": [
      3,
      4,
      "-",
      1,
      2
    ],
    "text": "Para un proyecto hay 3/4 de la cinta. Se utilizan 1/2. ¿Qué fracción queda? · 3/4 − 1/2",
    "answer": [
      1,
      4
    ],
    "wrong": [
      [
        2,
        3
      ],
      [
        1,
        3
      ],
      [
        1,
        2
      ]
    ],
    "explanation": "Usa el denominador común 4: 3/4 = 3/4 y 1/2 = 2/4. El resultado es 1/4, equivalente a 1/4.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 4 partes coloreadas y 1 de 2 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-31.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 5/6 de la cartulina. Se utilizan 1/3. ¿Qué fracción queda?",
    "operation": [
      5,
      6,
      "-",
      1,
      3
    ],
    "text": "Para un proyecto hay 5/6 de la cartulina. Se utilizan 1/3. ¿Qué fracción queda? · 5/6 − 1/3",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        2,
        3
      ],
      [
        4,
        9
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 6: 5/6 = 5/6 y 1/3 = 2/6. El resultado es 3/6, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 5 de 6 partes coloreadas y 1 de 3 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-32.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 7/8 del recorrido. Se utilizan 1/4. ¿Qué fracción queda?",
    "operation": [
      7,
      8,
      "-",
      1,
      4
    ],
    "text": "Para un proyecto hay 7/8 del recorrido. Se utilizan 1/4. ¿Qué fracción queda? · 7/8 − 1/4",
    "answer": [
      5,
      8
    ],
    "wrong": [
      [
        2,
        3
      ],
      [
        1,
        2
      ],
      [
        3,
        4
      ]
    ],
    "explanation": "Usa el denominador común 8: 7/8 = 7/8 y 1/4 = 2/8. El resultado es 5/8, equivalente a 5/8.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 7 de 8 partes coloreadas y 1 de 4 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-33.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 4/5 de la jarra. Se utilizan 1/10. ¿Qué fracción queda?",
    "operation": [
      4,
      5,
      "-",
      1,
      10
    ],
    "text": "Para un proyecto hay 4/5 de la jarra. Se utilizan 1/10. ¿Qué fracción queda? · 4/5 − 1/10",
    "answer": [
      7,
      10
    ],
    "wrong": [
      [
        1,
        3
      ],
      [
        1,
        5
      ],
      [
        4,
        5
      ]
    ],
    "explanation": "Usa el denominador común 10: 4/5 = 8/10 y 1/10 = 1/10. El resultado es 7/10, equivalente a 7/10.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 4 de 5 partes coloreadas y 1 de 10 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-34.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 5/6 de la parcela. Se utilizan 1/2. ¿Qué fracción queda?",
    "operation": [
      5,
      6,
      "-",
      1,
      2
    ],
    "text": "Para un proyecto hay 5/6 de la parcela. Se utilizan 1/2. ¿Qué fracción queda? · 5/6 − 1/2",
    "answer": [
      1,
      3
    ],
    "wrong": [
      [
        3,
        4
      ],
      [
        1,
        2
      ],
      [
        2,
        3
      ]
    ],
    "explanation": "Usa el denominador común 6: 5/6 = 5/6 y 1/2 = 3/6. El resultado es 2/6, equivalente a 1/3.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 5 de 6 partes coloreadas y 1 de 2 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-35.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 2/3 del listón. Se utilizan 1/6. ¿Qué fracción queda?",
    "operation": [
      2,
      3,
      "-",
      1,
      6
    ],
    "text": "Para un proyecto hay 2/3 del listón. Se utilizan 1/6. ¿Qué fracción queda? · 2/3 − 1/6",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        1,
        3
      ],
      [
        1,
        9
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 6: 2/3 = 4/6 y 1/6 = 1/6. El resultado es 3/6, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 2 de 3 partes coloreadas y 1 de 6 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-36.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 7/10 del libro. Se utilizan 1/5. ¿Qué fracción queda?",
    "operation": [
      7,
      10,
      "-",
      1,
      5
    ],
    "text": "Para un proyecto hay 7/10 del libro. Se utilizan 1/5. ¿Qué fracción queda? · 7/10 − 1/5",
    "answer": [
      1,
      2
    ],
    "wrong": [
      [
        8,
        15
      ],
      [
        2,
        5
      ],
      [
        1,
        1
      ]
    ],
    "explanation": "Usa el denominador común 10: 7/10 = 7/10 y 1/5 = 2/10. El resultado es 5/10, equivalente a 1/2.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 7 de 10 partes coloreadas y 1 de 5 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-37.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 11/12 de la tela. Se utilizan 1/3. ¿Qué fracción queda?",
    "operation": [
      11,
      12,
      "-",
      1,
      3
    ],
    "text": "Para un proyecto hay 11/12 de la tela. Se utilizan 1/3. ¿Qué fracción queda? · 11/12 − 1/3",
    "answer": [
      7,
      12
    ],
    "wrong": [
      [
        4,
        5
      ],
      [
        2,
        3
      ],
      [
        3,
        4
      ]
    ],
    "explanation": "Usa el denominador común 12: 11/12 = 11/12 y 1/3 = 4/12. El resultado es 7/12, equivalente a 7/12.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 11 de 12 partes coloreadas y 1 de 3 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-38.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 3/4 de la barra. Se utilizan 1/8. ¿Qué fracción queda?",
    "operation": [
      3,
      4,
      "-",
      1,
      8
    ],
    "text": "Para un proyecto hay 3/4 de la barra. Se utilizan 1/8. ¿Qué fracción queda? · 3/4 − 1/8",
    "answer": [
      5,
      8
    ],
    "wrong": [
      [
        1,
        3
      ],
      [
        1,
        6
      ],
      [
        3,
        4
      ]
    ],
    "explanation": "Usa el denominador común 8: 3/4 = 6/8 y 1/8 = 1/8. El resultado es 5/8, equivalente a 5/8.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 3 de 4 partes coloreadas y 1 de 8 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-39.svg"
  },
  {
    "category": "Heterogéneas",
    "prompt": "Para un proyecto hay 5/9 de la pista. Se utilizan 1/3. ¿Qué fracción queda?",
    "operation": [
      5,
      9,
      "-",
      1,
      3
    ],
    "text": "Para un proyecto hay 5/9 de la pista. Se utilizan 1/3. ¿Qué fracción queda? · 5/9 − 1/3",
    "answer": [
      2,
      9
    ],
    "wrong": [
      [
        1,
        2
      ],
      [
        1,
        3
      ],
      [
        4,
        9
      ]
    ],
    "explanation": "Usa el denominador común 9: 5/9 = 5/9 y 1/3 = 3/9. El resultado es 2/9, equivalente a 2/9.",
    "visual_alt": "Dos modelos con unidades del mismo tamaño: 5 de 9 partes coloreadas y 1 de 3 partes coloreadas. Operación: resta.",
    "image": "imagenes/ejercicio-40.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 1/2 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      1,
      2
    ],
    "text": "El modelo representa 1/2 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 1/2",
    "answer": [
      2,
      4
    ],
    "wrong": [
      [
        3,
        4
      ],
      [
        1,
        1
      ],
      [
        1,
        4
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 1 × 2 = 2 y 2 × 2 = 4. Por eso 1/2 = 2/4.",
    "visual_alt": "Modelo de una unidad dividida en 2 partes iguales, con 1 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-41.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 2/3 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      2,
      3
    ],
    "text": "El modelo representa 2/3 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 2/3",
    "answer": [
      6,
      9
    ],
    "wrong": [
      [
        5,
        6
      ],
      [
        2,
        1
      ],
      [
        2,
        9
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 2 × 3 = 6 y 3 × 3 = 9. Por eso 2/3 = 6/9.",
    "visual_alt": "Modelo de una unidad dividida en 3 partes iguales, con 2 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-42.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 3/4 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      3,
      4
    ],
    "text": "El modelo representa 3/4 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 3/4",
    "answer": [
      6,
      8
    ],
    "wrong": [
      [
        5,
        6
      ],
      [
        3,
        2
      ],
      [
        3,
        8
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 3 × 2 = 6 y 4 × 2 = 8. Por eso 3/4 = 6/8.",
    "visual_alt": "Modelo de una unidad dividida en 4 partes iguales, con 3 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-43.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 2/5 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      2,
      5
    ],
    "text": "El modelo representa 2/5 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 2/5",
    "answer": [
      8,
      20
    ],
    "wrong": [
      [
        2,
        3
      ],
      [
        8,
        5
      ],
      [
        1,
        10
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 2 × 4 = 8 y 5 × 4 = 20. Por eso 2/5 = 8/20.",
    "visual_alt": "Modelo de una unidad dividida en 5 partes iguales, con 2 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-44.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 3/7 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      3,
      7
    ],
    "text": "El modelo representa 3/7 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 3/7",
    "answer": [
      9,
      21
    ],
    "wrong": [
      [
        3,
        5
      ],
      [
        9,
        7
      ],
      [
        1,
        7
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 3 × 3 = 9 y 7 × 3 = 21. Por eso 3/7 = 9/21.",
    "visual_alt": "Modelo de una unidad dividida en 7 partes iguales, con 3 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-45.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 4/9 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      4,
      9
    ],
    "text": "El modelo representa 4/9 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 4/9",
    "answer": [
      8,
      18
    ],
    "wrong": [
      [
        6,
        11
      ],
      [
        8,
        9
      ],
      [
        2,
        9
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 4 × 2 = 8 y 9 × 2 = 18. Por eso 4/9 = 8/18.",
    "visual_alt": "Modelo de una unidad dividida en 9 partes iguales, con 4 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-46.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 5/6 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      5,
      6
    ],
    "text": "El modelo representa 5/6 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 5/6",
    "answer": [
      15,
      18
    ],
    "wrong": [
      [
        8,
        9
      ],
      [
        5,
        2
      ],
      [
        5,
        18
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 5 × 3 = 15 y 6 × 3 = 18. Por eso 5/6 = 15/18.",
    "visual_alt": "Modelo de una unidad dividida en 6 partes iguales, con 5 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-47.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 6/8 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      6,
      8
    ],
    "text": "El modelo representa 6/8 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 6/8",
    "answer": [
      12,
      16
    ],
    "wrong": [
      [
        4,
        5
      ],
      [
        3,
        2
      ],
      [
        3,
        8
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 6 × 2 = 12 y 8 × 2 = 16. Por eso 6/8 = 12/16.",
    "visual_alt": "Modelo de una unidad dividida en 8 partes iguales, con 6 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-48.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 3/12 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      3,
      12
    ],
    "text": "El modelo representa 3/12 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 3/12",
    "answer": [
      9,
      36
    ],
    "wrong": [
      [
        2,
        5
      ],
      [
        3,
        4
      ],
      [
        1,
        12
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 3 × 3 = 9 y 12 × 3 = 36. Por eso 3/12 = 9/36.",
    "visual_alt": "Modelo de una unidad dividida en 12 partes iguales, con 3 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-49.svg"
  },
  {
    "category": "Equivalencias",
    "prompt": "El modelo representa 5/10 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad?",
    "operation": [
      5,
      10
    ],
    "text": "El modelo representa 5/10 de una unidad. ¿Qué alternativa representa exactamente la misma cantidad? · Fracción equivalente a 5/10",
    "answer": [
      20,
      40
    ],
    "wrong": [
      [
        9,
        14
      ],
      [
        2,
        1
      ],
      [
        1,
        8
      ]
    ],
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 5 × 4 = 20 y 10 × 4 = 40. Por eso 5/10 = 20/40.",
    "visual_alt": "Modelo de una unidad dividida en 10 partes iguales, con 5 partes coloreadas. Busca una fracción equivalente.",
    "image": "imagenes/ejercicio-50.svg"
  }
]
BANK, true, 512, JSON_THROW_ON_ERROR);
