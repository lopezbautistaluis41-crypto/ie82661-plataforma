<?php
declare(strict_types=1);
return json_decode(<<<'BANK'
[
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      4,
      "+",
      2,
      4
    ],
    "text": "1/4 + 2/4",
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
    "explanation": "Conserva el denominador 4 y opera los numeradores: 1 + 2 = 3. El resultado es 3/4, equivalente a 3/4."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      5,
      "+",
      1,
      5
    ],
    "text": "2/5 + 1/5",
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
    "explanation": "Conserva el denominador 5 y opera los numeradores: 2 + 1 = 3. El resultado es 3/5, equivalente a 3/5."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      8,
      "+",
      2,
      8
    ],
    "text": "3/8 + 2/8",
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
    "explanation": "Conserva el denominador 8 y opera los numeradores: 3 + 2 = 5. El resultado es 5/8, equivalente a 5/8."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      6,
      "+",
      4,
      6
    ],
    "text": "1/6 + 4/6",
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
    "explanation": "Conserva el denominador 6 y opera los numeradores: 1 + 4 = 5. El resultado es 5/6, equivalente a 5/6."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      7,
      "+",
      3,
      7
    ],
    "text": "2/7 + 3/7",
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
    "explanation": "Conserva el denominador 7 y opera los numeradores: 2 + 3 = 5. El resultado es 5/7, equivalente a 5/7."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      10,
      "+",
      5,
      10
    ],
    "text": "3/10 + 5/10",
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
    "explanation": "Conserva el denominador 10 y opera los numeradores: 3 + 5 = 8. El resultado es 8/10, equivalente a 4/5."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      9,
      "+",
      6,
      9
    ],
    "text": "1/9 + 6/9",
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
    "explanation": "Conserva el denominador 9 y opera los numeradores: 1 + 6 = 7. El resultado es 7/9, equivalente a 7/9."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      4,
      12,
      "+",
      5,
      12
    ],
    "text": "4/12 + 5/12",
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
    "explanation": "Conserva el denominador 12 y opera los numeradores: 4 + 5 = 9. El resultado es 9/12, equivalente a 3/4."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      3,
      "+",
      1,
      3
    ],
    "text": "2/3 + 1/3",
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
    "explanation": "Conserva el denominador 3 y opera los numeradores: 2 + 1 = 3. El resultado es 3/3, equivalente a 1/1."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      5,
      8,
      "+",
      1,
      8
    ],
    "text": "5/8 + 1/8",
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
    "explanation": "Conserva el denominador 8 y opera los numeradores: 5 + 1 = 6. El resultado es 6/8, equivalente a 3/4."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      5,
      "-",
      1,
      5
    ],
    "text": "3/5 − 1/5",
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
    "explanation": "Conserva el denominador 5 y opera los numeradores: 3 − 1 = 2. El resultado es 2/5, equivalente a 2/5."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      7,
      8,
      "-",
      2,
      8
    ],
    "text": "7/8 − 2/8",
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
    "explanation": "Conserva el denominador 8 y opera los numeradores: 7 − 2 = 5. El resultado es 5/8, equivalente a 5/8."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      5,
      6,
      "-",
      2,
      6
    ],
    "text": "5/6 − 2/6",
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
    "explanation": "Conserva el denominador 6 y opera los numeradores: 5 − 2 = 3. El resultado es 3/6, equivalente a 1/2."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      6,
      7,
      "-",
      3,
      7
    ],
    "text": "6/7 − 3/7",
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
    "explanation": "Conserva el denominador 7 y opera los numeradores: 6 − 3 = 3. El resultado es 3/7, equivalente a 3/7."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      9,
      10,
      "-",
      4,
      10
    ],
    "text": "9/10 − 4/10",
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
    "explanation": "Conserva el denominador 10 y opera los numeradores: 9 − 4 = 5. El resultado es 5/10, equivalente a 1/2."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      8,
      9,
      "-",
      5,
      9
    ],
    "text": "8/9 − 5/9",
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
    "explanation": "Conserva el denominador 9 y opera los numeradores: 8 − 5 = 3. El resultado es 3/9, equivalente a 1/3."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      11,
      12,
      "-",
      7,
      12
    ],
    "text": "11/12 − 7/12",
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
    "explanation": "Conserva el denominador 12 y opera los numeradores: 11 − 7 = 4. El resultado es 4/12, equivalente a 1/3."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      4,
      5,
      "-",
      2,
      5
    ],
    "text": "4/5 − 2/5",
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
    "explanation": "Conserva el denominador 5 y opera los numeradores: 4 − 2 = 2. El resultado es 2/5, equivalente a 2/5."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      5,
      7,
      "-",
      1,
      7
    ],
    "text": "5/7 − 1/7",
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
    "explanation": "Conserva el denominador 7 y opera los numeradores: 5 − 1 = 4. El resultado es 4/7, equivalente a 4/7."
  },
  {
    "category": "Homogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      7,
      10,
      "-",
      3,
      10
    ],
    "text": "7/10 − 3/10",
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
    "explanation": "Conserva el denominador 10 y opera los numeradores: 7 − 3 = 4. El resultado es 4/10, equivalente a 2/5."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      2,
      "+",
      1,
      4
    ],
    "text": "1/2 + 1/4",
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
    "explanation": "Usa el denominador común 4: 1/2 = 2/4 y 1/4 = 1/4. El resultado es 3/4, equivalente a 3/4."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      3,
      "+",
      1,
      6
    ],
    "text": "1/3 + 1/6",
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
    "explanation": "Usa el denominador común 6: 1/3 = 2/6 y 1/6 = 1/6. El resultado es 3/6, equivalente a 1/2."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      3,
      "+",
      1,
      9
    ],
    "text": "2/3 + 1/9",
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
    "explanation": "Usa el denominador común 9: 2/3 = 6/9 y 1/9 = 1/9. El resultado es 7/9, equivalente a 7/9."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      4,
      "+",
      2,
      8
    ],
    "text": "1/4 + 2/8",
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
    "explanation": "Usa el denominador común 8: 1/4 = 2/8 y 2/8 = 2/8. El resultado es 4/8, equivalente a 1/2."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      5,
      "+",
      1,
      10
    ],
    "text": "2/5 + 1/10",
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
    "explanation": "Usa el denominador común 10: 2/5 = 4/10 y 1/10 = 1/10. El resultado es 5/10, equivalente a 1/2."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      4,
      "+",
      1,
      8
    ],
    "text": "3/4 + 1/8",
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
    "explanation": "Usa el denominador común 8: 3/4 = 6/8 y 1/8 = 1/8. El resultado es 7/8, equivalente a 7/8."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      2,
      "+",
      2,
      6
    ],
    "text": "1/2 + 2/6",
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
    "explanation": "Usa el denominador común 6: 1/2 = 3/6 y 2/6 = 2/6. El resultado es 5/6, equivalente a 5/6."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      3,
      "+",
      1,
      6
    ],
    "text": "2/3 + 1/6",
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
    "explanation": "Usa el denominador común 6: 2/3 = 4/6 y 1/6 = 1/6. El resultado es 5/6, equivalente a 5/6."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      5,
      "+",
      1,
      2
    ],
    "text": "3/5 + 1/2",
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
    "explanation": "Usa el denominador común 10: 3/5 = 6/10 y 1/2 = 5/10. El resultado es 11/10, equivalente a 11/10."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      1,
      3,
      "+",
      3,
      4
    ],
    "text": "1/3 + 3/4",
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
    "explanation": "Usa el denominador común 12: 1/3 = 4/12 y 3/4 = 9/12. El resultado es 13/12, equivalente a 13/12."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      4,
      "-",
      1,
      2
    ],
    "text": "3/4 − 1/2",
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
    "explanation": "Usa el denominador común 4: 3/4 = 3/4 y 1/2 = 2/4. El resultado es 1/4, equivalente a 1/4."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      5,
      6,
      "-",
      1,
      3
    ],
    "text": "5/6 − 1/3",
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
    "explanation": "Usa el denominador común 6: 5/6 = 5/6 y 1/3 = 2/6. El resultado es 3/6, equivalente a 1/2."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      7,
      8,
      "-",
      1,
      4
    ],
    "text": "7/8 − 1/4",
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
    "explanation": "Usa el denominador común 8: 7/8 = 7/8 y 1/4 = 2/8. El resultado es 5/8, equivalente a 5/8."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      4,
      5,
      "-",
      1,
      10
    ],
    "text": "4/5 − 1/10",
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
    "explanation": "Usa el denominador común 10: 4/5 = 8/10 y 1/10 = 1/10. El resultado es 7/10, equivalente a 7/10."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      5,
      6,
      "-",
      1,
      2
    ],
    "text": "5/6 − 1/2",
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
    "explanation": "Usa el denominador común 6: 5/6 = 5/6 y 1/2 = 3/6. El resultado es 2/6, equivalente a 1/3."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      2,
      3,
      "-",
      1,
      6
    ],
    "text": "2/3 − 1/6",
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
    "explanation": "Usa el denominador común 6: 2/3 = 4/6 y 1/6 = 1/6. El resultado es 3/6, equivalente a 1/2."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      7,
      10,
      "-",
      1,
      5
    ],
    "text": "7/10 − 1/5",
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
    "explanation": "Usa el denominador común 10: 7/10 = 7/10 y 1/5 = 2/10. El resultado es 5/10, equivalente a 1/2."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      11,
      12,
      "-",
      1,
      3
    ],
    "text": "11/12 − 1/3",
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
    "explanation": "Usa el denominador común 12: 11/12 = 11/12 y 1/3 = 4/12. El resultado es 7/12, equivalente a 7/12."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      3,
      4,
      "-",
      1,
      8
    ],
    "text": "3/4 − 1/8",
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
    "explanation": "Usa el denominador común 8: 3/4 = 6/8 y 1/8 = 1/8. El resultado es 5/8, equivalente a 5/8."
  },
  {
    "category": "Heterogéneas",
    "prompt": "Calcula y elige la fracción correcta.",
    "operation": [
      5,
      9,
      "-",
      1,
      3
    ],
    "text": "5/9 − 1/3",
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
    "explanation": "Usa el denominador común 9: 5/9 = 5/9 y 1/3 = 3/9. El resultado es 2/9, equivalente a 2/9."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      1,
      2
    ],
    "text": "Fracción equivalente a 1/2",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 1 × 2 = 2 y 2 × 2 = 4. Por eso 1/2 = 2/4."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      2,
      3
    ],
    "text": "Fracción equivalente a 2/3",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 2 × 3 = 6 y 3 × 3 = 9. Por eso 2/3 = 6/9."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      3,
      4
    ],
    "text": "Fracción equivalente a 3/4",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 3 × 2 = 6 y 4 × 2 = 8. Por eso 3/4 = 6/8."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      2,
      5
    ],
    "text": "Fracción equivalente a 2/5",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 2 × 4 = 8 y 5 × 4 = 20. Por eso 2/5 = 8/20."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      3,
      7
    ],
    "text": "Fracción equivalente a 3/7",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 3 × 3 = 9 y 7 × 3 = 21. Por eso 3/7 = 9/21."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      4,
      9
    ],
    "text": "Fracción equivalente a 4/9",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 4 × 2 = 8 y 9 × 2 = 18. Por eso 4/9 = 8/18."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      5,
      6
    ],
    "text": "Fracción equivalente a 5/6",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 5 × 3 = 15 y 6 × 3 = 18. Por eso 5/6 = 15/18."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      6,
      8
    ],
    "text": "Fracción equivalente a 6/8",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 6 × 2 = 12 y 8 × 2 = 16. Por eso 6/8 = 12/16."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      3,
      12
    ],
    "text": "Fracción equivalente a 3/12",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 3 × 3 = 9 y 12 × 3 = 36. Por eso 3/12 = 9/36."
  },
  {
    "category": "Equivalencias",
    "prompt": "¿Qué fracción es equivalente a la que se muestra?",
    "operation": [
      5,
      10
    ],
    "text": "Fracción equivalente a 5/10",
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
    "explanation": "Multiplica el numerador y el denominador por el mismo número: 5 × 4 = 20 y 10 × 4 = 40. Por eso 5/10 = 20/40."
  }
]
BANK, true, 512, JSON_THROW_ON_ERROR);
